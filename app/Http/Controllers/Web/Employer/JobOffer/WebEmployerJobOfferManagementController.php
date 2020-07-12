<?php

namespace App\Http\Controllers\Web\Employer\JobOffer;

use App\Http\Controllers\Controller;
use App\Models\JobOffer\JobOffer;
use App\Models\JobOffer\JobOfferUpdate;

class WebEmployerJobOfferManagementController extends Controller
{
    public function displayJobOffers()
    {
        $job_offers = JobOffer::where('employer_id', auth()->user()->employer->id)
            ->orderBy('created_at', 'desc')->get();

        $job_offer_updates = JobOfferUpdate::whereIn('job_offer_id', $job_offers->pluck('id'))
            ->limit(10)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('employer.job_offer.manage_job_offers')
            ->with('job_offers', $job_offers)
            ->with('job_offer_updates', $job_offer_updates);
    }
}
