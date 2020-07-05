<?php

namespace App\Http\Controllers\Web\Employer\JobPost;

use App\Http\Controllers\Controller;
use App\Models\JobPost\JobPost;
use App\Models\JobPost\JobPostApplication;

class WebEmployerJobPostManagementController extends Controller
{
    public function displayListPage()
    {
        $employer_id = auth()->user()->employer->id;

        $job_posts = JobPost::where('employer_id', $employer_id)
            ->orderBy('created_at', 'desc')
            ->get();

        $job_post_ids = array();
        foreach ($job_posts as $job_post) {
            array_push($job_post_ids, $job_post->id);
        }

        $job_applications = JobPostApplication::where('job_post_id', $job_post_ids)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('employer.job_post.manage_job_posts')
            ->with('job_posts', $job_posts)
            ->with('job_applications', $job_applications);
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
