<?php

namespace App\Http\Services\Backend;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class WriterService
{
    public function dataTable($request)
    {
        if ($request->ajax()) {
            $totalData = User::count();
            $totalFiltered = $totalData;

            $limit = $request->length;
            $start = $request->start;

            if (empty($request->search['value'])) {
                $data = User::offset($start)
                    ->limit($limit)
                    ->get(['id', 'name', 'email', 'created_at', 'is_verified']);
            } else {
                $data = User::filter($request->search['value'])
                    ->offset($start)
                    ->limit($limit)
                    ->get(['id', 'name', 'email', 'created_at', 'is_verified']);

                $totalFiltered = $data->count();
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->setOffset($start)
                ->editColumn('created_at', fn($data) => date('d-m-Y H:i:s', strtotime($data->created_at . ' +7 hours')))
                ->editColumn('is_verified', fn($data) => $data->is_verified
                    ? '<span class="badge bg-success">' . date('d-m-Y H:i:s', strtotime($data->is_verified . ' +7 hours')) . '</span>'
                    : '<span class="badge bg-danger">Unverified</span>')
                ->addColumn('action', fn($data) => '
                    <div class="text-center" width="10%">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-success" onclick="editData(this)" data-id="' . $data->id . '">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteData(this)" data-id="' . $data->id . '">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                ')
                ->with([
                    'recordsTotal' => $totalData,
                    'recordsFiltered' => $totalFiltered,
                    'start' => $start,
                ])
                ->rawColumns(['action', 'is_verified'])
                ->make();
        }
    }

    public function getFirstBy(string $column, string $value)
    {
        return User::where($column, $value)->firstOrFail();
    }

    public function update(array $data, $id)
    {
        $user = User::findOrFail($id);
        return $user->update($data);
    }
}
