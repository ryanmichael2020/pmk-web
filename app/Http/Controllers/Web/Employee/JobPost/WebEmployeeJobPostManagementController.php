<?php

namespace App\Http\Controllers\Web\Employee\JobPost;

use App\Http\Controllers\Controller;
use App\Models\JobPost\JobPost;

class WebEmployeeJobPostManagementController extends Controller
{
    public function displayListPage()
    {
        $job_posts = JobPost::all();

        return view('employee.job_post.list_job_posts')
            ->with('job_posts', $job_posts);
    }
}
