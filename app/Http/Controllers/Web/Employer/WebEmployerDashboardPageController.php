<?php

namespace App\Http\Controllers\Web\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebEmployerDashboardPageController extends Controller
{
    public function displayDashboardPage() {
        // TODO :: Update dashboard layout
        return redirect('/employer/job_posts');
        // return view('employer.dashboard');
    }
}
