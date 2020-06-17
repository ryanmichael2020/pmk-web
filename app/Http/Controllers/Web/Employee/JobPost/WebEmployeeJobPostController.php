<?php

namespace App\Http\Controllers\Web\Employee\JobPost;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\JobPost\JobPostApplicationController;
use App\Http\Requests\JobPostApplication\CreateJobPostApplicationRequest;
use Illuminate\Http\Response;

class WebEmployeeJobPostController extends Controller
{
    public function apply(CreateJobPostApplicationRequest $request)
    {
        $job_post_id = $request->job_post_id;
        $employee_id = $request->employee_id;

        $response = JobPostApplicationController::create($job_post_id, $employee_id);
        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);
        }

        return redirect()->back();
    }
}
