<?php

namespace App\Http\Controllers\Core\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\CompanyReview;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CompanyReviewController extends Controller
{
    public static function createReview($employee_id, $company_id, $score, $comment)
    {
        $response = array();

        try {
            $is_allowed_to_submit_review = true;

            $company_reviews = CompanyReview::where('company_id', $company_id)
                ->where('employee_id', $employee_id)->first();

            if ($company_reviews == null) {
                $company_review = new CompanyReview();
                $company_review->employee_id = $employee_id;
                $company_review->company_id = $company_id;
                $company_review->score = $score;
                $company_review->comment = $comment;
                $company_review->save();

                $data = array();
                $data['company_review'] = $company_review;

                $response['data'] = $data;
                $response['message'] = 'Company review successfully created.';
                $response['status_code'] = Response::HTTP_OK;
            } else {
                $error = array();
                $error['message'] = 'You have already submitted a review for this company.';

                $response['error'] = $error;
                $response['message'] = 'Failed to submit review.';
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
            $response['message'] = 'Failed to create company review.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to create company review.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }
}
