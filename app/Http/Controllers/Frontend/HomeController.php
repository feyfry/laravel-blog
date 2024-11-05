<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Http\Services\Frontend\ArticleService;
use App\Http\Services\Frontend\CategoryService;

class HomeController extends Controller
{

    public function __construct(private ArticleService $articleService, private CategoryService $categoryService)
    {}

    public function index()
    {
        // artikel terbaru
        $main_post = Article::with('category:id,name', 'user:id,name')
            ->select('id', 'user_id', 'category_id', 'title', 'slug', 'content', 'published', 'is_confirm', 'views', 'image')
            ->latest()
            ->where('published', true)
            ->where(function ($query) {
                $query->where('is_confirm', true)
                    ->orWhereNull('is_confirm');
            })
            ->first();

        // artikel terpopuler
        $top_view = Article::with('category:id,name', 'tags:id,name')
            ->select('id', 'category_id', 'title', 'slug', 'content', 'published', 'is_confirm', 'views', 'image')
            ->orderBy('views', 'desc')
            ->where('published', true)
            ->where(function ($query) {
                $query->where('is_confirm', true)
                    ->orWhereNull('is_confirm');
            })
            ->first();

        // artikel terbaru semua kategori
        $main_post_all = collect();
        if ($main_post) {
            $main_post_all = Article::with('category:id,name')
                ->select('id', 'category_id', 'title', 'slug', 'published', 'is_confirm', 'views', 'image')
                ->latest()
                ->where('published', true)
                ->where(function ($query) {
                    $query->where('is_confirm', true)
                        ->orWhereNull('is_confirm');
                })
                ->where('id', '!=', $main_post->id)
                ->limit(6)
                ->get();
        }

        $latest_articles = $this->articleService->latestArticles();
        $popularArticles = $this->articleService->getPopularArticles();
        $laravelArticles = $this->articleService->getLaravelArticles();
        $categoryArticles = $this->categoryService->getArticlesByCategory();

        // return dd([
        //     'popularArticles' => $popularArticles,
        //     'laravelArticles' => $laravelArticles
        // ]);

        return view('frontend.home.index', [
            'main_post' => $main_post,
            'top_view' => $top_view,
            'main_post_all' => $main_post_all,
            'latest_articles' => $latest_articles,
            'popularArticles' => $popularArticles,
            'laravelArticles' => $laravelArticles,
            'categoryArticles' => $categoryArticles
        ]);
    }
}
