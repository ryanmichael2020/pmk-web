<?php

namespace App\Http\Controllers\Web\Employee\JobPostApplication;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\JobPost\JobPostApplicationController;
use App\Http\Requests\JobPostApplication\UpdateJobPostApplicationRequest;
use App\Models\JobPost\JobPostApplicationStatus;
use Illuminate\Http\Response;

class WebEmployeeJobPostApplicationController extends Controller
{
    public function updateJobPostApplication(UpdateJobPostApplicationRequest $request)
    {
        $job_post_application_id = $request->job_post_application_id;
        $job_post_application_status_id = $request->job_post_application_status_id;

        $response = JobPostApplicationController::update($job_post_application_id, $job_post_application_status_id);
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
