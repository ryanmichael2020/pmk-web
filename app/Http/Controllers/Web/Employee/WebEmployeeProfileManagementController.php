<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Employee\EmployeeController;
use App\Http\Controllers\Core\User\UserController;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\Response;

class WebEmployeeProfileManagementController extends Controller
{
    public function updateEmployeeAccount(UpdateUserRequest $request)
    {
        $email = $request->email;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $sex = $request->sex;

        $user_id = auth()->user()->id;

        $response = UserController::update($user_id, $email, $first_name, $last_name, $sex);
        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);
        }

        return redirect()->back();
    }

    public function updateEmployeeDetails(UpdateEmployeeRequest $request)
    {
        $age = $request->age;
        $address = $request->address;
        $mobile = $request->mobile;

        $employee_id = auth()->user()->employee->id;

        $response = EmployeeController::update($employee_id, $age, $address, $mobile);
        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);
        }

        return redirect()->back();
    }
}
