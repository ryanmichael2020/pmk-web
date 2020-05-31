<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;

class WebEmployeeProfileManagementPageController extends Controller
{
    public function displayProfileDashboardPage()
    {
        return view('employee.profile.dashboard');
    }
}
