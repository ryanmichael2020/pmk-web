<?php

namespace App\Http\Controllers\Web\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\Company;
use App\Models\Company\CompanyReview;
use App\Models\Employee\Employee;
use App\Models\User\UserType;

class WebCompanyDetailController extends Controller
{
    public function displayDetailPage($company_id)
    {
        $company = Company::where('id', $company_id)->first();
        $company_reviews = CompanyReview::where('company_id', $company->id)->get();

        $score_total = 0;
        $score_count = 0;
        foreach ($company_reviews as $company_review) {
            $score_total += $company_review->score;
            $score_count++;
        }

        $score_average = ($score_count != 0) ? ($score_total / $score_count) : 0;

        $can_submit_review = true;
        if (auth()->user()->user_type_id == UserType::$EMPLOYEE) {
            foreach ($company_reviews as $company_review) {
                if ($company_review->employee_id == auth()->user()->employee->id && $company_review->company_id == $company_id) {
                    $can_submit_review = false;
                }
            }
        } else {
            $can_submit_review = false;
        }

        return view('company.company_detail')
            ->with('company', $company)
            ->with('company_reviews', $company_reviews)
            ->with('company_rating', $score_average)
            ->with('can_submit_review', $can_submit_review);
    }

    public function displayCompanyEmployeesPage($company_id)
    {
        $company = Company::where('id', $company_id)->first();
        $company_reviews = CompanyReview::where('company_id', $company->id)->get();

        $score_total = 0;
        $score_count = 0;
        foreach ($company_reviews as $company_review) {
            $score_total += $company_review->score;
            $score_count++;
        }

        $score_average = ($score_count != 0) ? ($score_total / $score_count) : 0;
        $employees = Employee::where('company_id', $company_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('company.company_employees')
            ->with('company', $company)
            ->with('company_rating', $score_average)
            ->with('employees', $employees);
    }
}
