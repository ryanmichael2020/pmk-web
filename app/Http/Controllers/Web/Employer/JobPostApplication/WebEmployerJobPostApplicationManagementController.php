<?php

namespace App\Http\Controllers\Web\Employer\JobPostApplication;

use App\Http\Controllers\Controller;
use App\Models\JobPost\JobPost;
use App\Models\JobPost\JobPostApplication;

class WebEmployerJobPostApplicationManagementController extends Controller
{
    public function displayJobPostApplicants($job_post_id)
    {
        $job_post = JobPost::where('id', $job_post_id)->first();
        $job_post_applications = JobPostApplication::where('job_post_id', $job_post_id)->get();

        return view('employer.job_post_application.list_job_post_applications')
            ->with('job_post', $job_post)
            ->with('job_post_applications', $job_post_applications);
    }
}
