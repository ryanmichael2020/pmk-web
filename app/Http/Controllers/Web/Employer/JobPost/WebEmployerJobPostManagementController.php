<?php

namespace App\Http\Controllers\Web\Employer\JobPost;

use App\Http\Controllers\Controller;
use App\Models\JobPost\JobPost;

class WebEmployerJobPostManagementController extends Controller
{
    public function displayListPage()
    {
        return view('employer.job_post.manage_job_posts');
    }

    public function displayCreatePage()
    {
        return view('employer.job_post.create_job_post');
    }

    public function displayUpdatePage($job_post_id)
    {
        $job_post = JobPost::where('id', $job_post_id)->first();

        return view('employer.job_post.update_job_post')
            ->with('job_post', $job_post);
    }
}
