<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\User\User;

class WebEmployeeManagementController extends Controller
{
    public function displayListPage()
    {
        return view('admin.employee.manage_employees');
    }

    public function displayProfilePeekUnrelatedPage($employee_id)
    {
        $employee = Employee::where('id', $employee_id)->first();
        $user = User::where('id', $employee->user_id)->first();

        return view('employee.profile.profile_peek_unrelated')
            ->with('user', $user)
            ->with('employee', $employee);
    }
}
