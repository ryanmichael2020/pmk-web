<?php

namespace App\Http\Controllers\Web\JobOffer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\JobOffer\JobOfferController;
use App\Http\Requests\JobOffer\CreateJobOfferRequest;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class WebJobOfferController extends Controller
{
    public function hireApplicant(CreateJobOfferRequest $request)
    {
        Log::debug(json_encode($request->all()));

        $job_post_application_id = $request->job_post_application_id;
        $description = $request->description;

        // TODO :: update date due based on requirements or input
        $date_due = ($request->has('date_due')) ? $request->date_due : Carbon::now()->addDays(7);

        $response = JobOfferController::hireApplicant($job_post_application_id, $date_due, $description);
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
