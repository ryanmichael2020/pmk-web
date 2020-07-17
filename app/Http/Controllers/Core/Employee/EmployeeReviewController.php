<?php

namespace App\Http\Controllers\Core\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee\EmployeeReview;
use App\Models\Employee\EmployeeReviewScore;
use App\Models\Employee\EmployeeReviewType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeReviewController extends Controller
{
    public static function createReview($company_id, $employee_id, $punctuality_score, $performance_score, $personality_score)
    {
        $response = array();

        try {
            $employee_review = EmployeeReview::where('company_id', $company_id)
                ->where('employee_id', $employee_id)->first();

            if ($employee_review != null) {
                DB::beginTransaction();

                // no employee review exists
                $score_average = (($punctuality_score + $performance_score + $personality_score) / 3);
                $employee_review = new EmployeeReview();
                $employee_review->score = $score_average;
                $employee_review->company_id = $company_id;
                $employee_review->employee_id = $employee_id;

                $emp_punc_score = new EmployeeReviewScore();
                $emp_punc_score->employee_review_id = $employee_review->id;
                $emp_punc_score->employee_review_type_id = EmployeeReviewType::$PUNCTUALITY;
                $emp_punc_score->score = $punctuality_score;
                $emp_punc_score->save();

                $emp_perf_score = new EmployeeReviewScore();
                $emp_perf_score->employee_review_id = $employee_review->id;
                $emp_perf_score->employee_review_type_id = EmployeeReviewType::$PERFORMANCE;
                $emp_perf_score->score = $performance_score;
                $emp_perf_score->save();

                $emp_pers_score = new EmployeeReviewScore();
                $emp_pers_score->employee_review_id = $employee_review->id;
                $emp_pers_score->employee_review_type_id = EmployeeReviewType::$PERSONALITY;
                $emp_pers_score->score = $personality_score;
                $emp_pers_score->save();

                DB::commit();

                $employee_review_scores = array();
                array_push($employee_review_scores, $emp_punc_score);
                array_push($employee_review_scores, $emp_perf_score);
                array_push($employee_review_scores, $emp_pers_score);

                $data = array();
                $data['employee_review'] = $employee_review;
                $data['employee_review']['employee_review_scores'] = $employee_review_scores;

                $response['data'] = $data;
                $response['message'] = 'Employee review successfully created.';
                $response['status_code'] = Response::HTTP_OK;
            } else {
                // employee review exists
                $error = array();
                $error['message'] = 'Employee review from the company already exists.';

                $response['error'] = $error;
                $response['message'] = 'Failed to create employee review.';
                $response['status_code'] = Response::HTTP_BAD_REQUEST;
            }
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error_code = $exception->errorInfo[1];
            Log::error($error_code);

            $error = array();
            $error['message'] = 'Query exception occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to create employee review.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to create employee review.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }
}
