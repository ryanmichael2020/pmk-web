<?php

namespace App\Http\Controllers\Web\Employer\JobOffer;

use App\Http\Controllers\Controller;
use App\Models\JobOffer\JobOffer;

class WebEmployerJobOfferManagementController extends Controller
{
    public function displayJobOffers()
    {
        $job_offers = JobOffer::where('employer_id', auth()->user()->employer->id)
            ->orderBy('created_at', 'desc')->get();

        return view('employer.job_offer.manage_job_offers')
            ->with('job_offers', $job_offers);
    }
}
