<?php

namespace App\Http\Controllers\Web\Employee\JobPostApplication;

use App\Http\Controllers\Controller;
use App\Models\JobPost\JobPost;
use App\Models\JobPost\JobPostApplication;
use Illuminate\Http\Request;

class WebEmployeeJobPostApplicationManagementController extends Controller
{
    public function displayListPage()
    {
        $employee_id = auth()->user()->employee->id;
        $job_post_applications = JobPostApplication::where('employee_id', $employee_id)->get();

        return view('employee.job_post_application.list_job_post_applications')
            ->with('job_post_applications', $job_post_applications);
    }
}
