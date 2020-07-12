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

    public function displayProfilePeekUnrelatedPage($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $employee = Employee::where('id', $user->employee->id)->first();

        return view('employee.profile.profile_peek_unrelated')
            ->with('user', $user)
            ->with('employee', $employee);
    }
}
