<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Buat instance controller baru.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan halaman dashboard aplikasi.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $data = [];

        // Query dasar berbeda-beda tergantung pada role/peran pengguna
        // Jika pengguna adalah owner, maka query akan mengambil semua artikel
        // Jika pengguna adalah writer, maka query akan mengambil artikel berdasarkan user_id yang sama dengan user yang login
        //
        $articlesQuery = $user->role === 'owner'
        ? Article::query()
        : Article::where('user_id', $user->id);

        // Statistik dasar
        $data['totalArticles'] = $articlesQuery->count();
        $data['draftArticles'] = (clone $articlesQuery)->where('published', 0)->count();
        $data['publishedArticles'] = (clone $articlesQuery)->where('published', 1)->count();
        $data['confirmedArticles'] = (clone $articlesQuery)->where('is_confirm', 1)->count();
        $data['unConfirmedArticles'] = (clone $articlesQuery)->where('is_confirm', 0)->count();

        // Tambahkan jumlah total writer jika pengguna adalah owner
        if ($user->role === 'owner') {
            $data['totalWriters'] = User::where('role', 'writer')->count();
        }

        // Dapatkan statistik kategori
        if ($user->role === 'owner') {
            $data['categoryStats'] = Category::withCount('articles')->get();
        } else {
            $data['categoryStats'] = Category::withCount(['articles' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }])->get();
        }

        // Dapatkan artikel terbaru
        $data['recentArticles'] = (clone $articlesQuery)
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Data untuk chart artikel harian (7 hari terakhir)
        $lastWeekDates = collect(range(6, 0))->map(function ($days) {
            return Carbon::now()->subDays($days)->format('Y-m-d');
        });


        // Dapatkan data artikel per hari untuk 7 hari terakhir
        // query diatas akan mengembalikan data berupa array dengan key tanggal dan value jumlah artikel yang dibuat pada tanggal tersebut
        // misal: ['2024-07-01' => 3, '2024-07-02' => 2, ...]
        $dailyArticles = (clone $articlesQuery)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc') // Order by date instead of created_at
            ->get()
            ->pluck('count', 'date');

        // Pastikan kita memiliki data untuk 7 hari terakhir, kalo ga punya data nya, buat dulu agar tampil pada chart
        $chartData = $lastWeekDates->map(function ($date) use ($dailyArticles) {
            return $dailyArticles[$date] ?? 0;
        });

        $data['chartLabels'] = $lastWeekDates->values();
        $data['chartData'] = $chartData->values();

        // Data distribusi status
        $data['statusDistribution'] = [
            'draft' => (clone $articlesQuery)->where('published', 0)->count(),
            'published' => (clone $articlesQuery)->where('published', 1)->where('is_confirm', 0)->count(),
            'confirmed' => (clone $articlesQuery)->where('is_confirm', 1)->count(),
            'unconfirmed' => (clone $articlesQuery)->where('is_confirm', 0)->count(),
        ];

        return view('home', compact('data'));
    }
}
