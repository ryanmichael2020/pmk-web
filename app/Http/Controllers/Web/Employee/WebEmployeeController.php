<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\User\User;
use Yajra\DataTables\DataTables;

class WebEmployeeController extends Controller
{
    private function detailedViewRoute($id)
    {
        return "/admin/management/employee/$id";
    }

    private function editRoute($id)
    {
        return "/admin/management/employee/$id/update";
    }

    public function getDataTable()
    {
        $employee_user_ids = Employee::all()->pluck('user_id');
        $employees = User::with('userDetail', 'employee')
            ->whereIn('id', $employee_user_ids)->get();

        $data = DataTables::of($employees)
            ->addColumn('action', function ($data) {
                $button = '<a href="' . $this->editRoute($data->id) . '" class="mx-1" title="Edit"><i class="fas fa-edit fa-lg"></i></a>';
                $button .= '<a href="' . $this->detailedViewRoute($data->id) . '" class="mx-1" title="View"><i class="fas fa-eye fa-lg"></i></a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);

        return $data;
    }
}
