<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Employee\EmployeeController;
use App\Http\Requests\Employee\DismissEmployeeRequest;
use App\Models\Employee\Employee;
use App\Models\User\User;
use App\Models\User\UserType;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class WebEmployeeController extends Controller
{
    private function detailedViewRoute($id)
    {
        if (auth()->user()->user_type_id == UserType::$ADMIN) {
            return "/admin/management/employee/$id/profile";
        } else {
            return "/employee/$id/profile";
        }
    }

    private function editRoute($id)
    {
        return "/admin/management/employee/$id/profile/update";
    }

    public function dismissEmployee(DismissEmployeeRequest $request)
    {
        $employee_id = $request->employee_id;
        $employer_id = $request->employer_id;

        // TODO :: use employer id for action logs
        $response = EmployeeController::dismissEmployee($employee_id);
        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);
        }

        return redirect()->back();
    }

    public function getDataTable()
    {
        $employee_user_ids = Employee::all()->pluck('user_id');
        $employees = User::with('userDetail', 'employee')
            ->whereIn('id', $employee_user_ids)->get();

        $data = DataTables::of($employees)
            ->addColumn('action', function ($data) {
                // $button = '<a href="' . $this->editRoute($data->id) . '" class="mx-1" title="Edit"><i class="fas fa-edit fa-lg"></i></a>';
                $button = '<a href="' . $this->detailedViewRoute($data->employee->id) . '" class="mx-1" title="View"><i class="fas fa-eye fa-lg"></i></a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);

        return $data;
    }

    public function getDataTableByCompanyId($company_id)
    {
        $employee_user_ids = Employee::where('company_id', $company_id)->pluck('user_id');
        $employees = User::with('userDetail', 'employee')
            ->whereIn('id', $employee_user_ids)->get();

        $data = DataTables::of($employees)
            ->addColumn('action', function ($data) {
                // $button = '<a href="' . $this->editRoute($data->id) . '" class="mx-1" title="Edit"><i class="fas fa-edit fa-lg"></i></a>';
                $button = '<a href="' . $this->detailedViewRoute($data->employee->id) . '" class="mx-1" title="View"><i class="fas fa-eye fa-lg"></i></a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);

        return $data;
    }
}
