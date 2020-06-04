<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\User\User;

class WebEmployeeProfileManagementPageController extends Controller
{
    public function displayProfileDashboardPage()
    {
        return view('employee.profile.dashboard');
    }

    public function displayProfileAccountUpdatePage()
    {
        $user_id = auth()->user()->id;
        $user = User::with('userDetail')->where('id', $user_id)->first();

        return view('employee.profile.update_account')
            ->with('user', $user);
    }

    public function displayProfileDetailsUpdatePage()
    {
        $user_id = auth()->user()->id;
        $employee = Employee::where('user_id', $user_id)->first();

        return view('employee.profile.update_details')->with('employee', $employee);
    }
}
