<?php

namespace App\Http\Controllers\Web\Employee\JobOffer;

use App\Http\Controllers\Controller;
use App\Models\JobOffer\JobOffer;

class WebEmployeeJobOfferManagementController extends Controller
{
    public function displayListPage()
    {
        $job_offers = JobOffer::where('employee_id', auth()->user()->employee->id)
            ->orderBy('created_at', 'desc')->get();

        return view('employee.job_offer.list_job_offers')
            ->with('job_offers', $job_offers);
    }
}
