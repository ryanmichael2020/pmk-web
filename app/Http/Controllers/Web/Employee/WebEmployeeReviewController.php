<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Employee\EmployeeReviewController;
use App\Http\Requests\Employee\CreateEmployeeReviewRequest;

class WebEmployeeReviewController extends Controller
{
    public function createEmployeeReview(CreateEmployeeReviewRequest $request)
    {
        $company_id = $request->company_id;
        $employee_id = $request->employee_id;
        $punctuality_score = $request->punctuality_score;
        $performance_score = $request->performance_score;
        $personality_score = $request->personality_score;

        $response = EmployeeReviewController::createReview($company_id, $employee_id, $punctuality_score, $personality_score, $performance_score);
        if ($response['status_code'] >= 200 && $response['status_code'] < 300) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);
        }

        return redirect()->back();
    }
}
