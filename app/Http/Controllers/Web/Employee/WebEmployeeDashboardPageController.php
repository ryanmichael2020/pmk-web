<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;

class WebEmployeeDashboardPageController extends Controller
{
    public function displayDashboardPage()
    {
        return view('employee.dashboard');
    }
}
