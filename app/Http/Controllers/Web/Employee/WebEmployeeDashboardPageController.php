<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;

class WebEmployeeDashboardPageController extends Controller
{
    public function displayDashboardPage()
    {
        // TODO :: Update dashboard page
        return redirect('/job_posts');
        // return view('employee.dashboard');
    }
}
