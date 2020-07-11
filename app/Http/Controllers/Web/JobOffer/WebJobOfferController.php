<?php

namespace App\Http\Controllers\Web\JobOffer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\JobOffer\JobOfferController;
use App\Http\Requests\JobOffer\AcceptJobOfferRequest;
use App\Http\Requests\JobOffer\CreateJobOfferRequest;
use App\Http\Requests\JobOffer\RejectJobOfferRequest;
use Carbon\Carbon;
use Illuminate\Http\Response;

class WebJobOfferController extends Controller
{
    public function hireApplicant(CreateJobOfferRequest $request)
    {
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

    public function acceptJobOffer(AcceptJobOfferRequest $request)
    {
        $job_offer_id = $request->job_offer_id;

        $response = JobOfferController::acceptJobOffer($job_offer_id);
        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);
        }

        return redirect()->back();
    }

    public function rejectJobOffer(RejectJobOfferRequest $request)
    {
        $job_offer_id = $request->job_offer_id;

        $response = JobOfferController::rejectJobOffer($job_offer_id);
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
