<?php

namespace App\Http\Controllers\Core\JobOffer;

use App\Http\Controllers\Controller;
use App\Models\Employee\EmployeeCompanyHistory;
use App\Models\JobOffer\JobOffer;
use App\Models\JobOffer\JobOfferStatus;
use App\Models\JobPost\JobPostApplication;
use App\Models\JobPost\JobPostApplicationStatus;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class JobOfferController extends Controller
{
    public static function hireApplicant($job_post_application_id, $date_due, $description = null)
    {
        $response = array();

        try {
            $job_post_application = JobPostApplication::where('id', $job_post_application_id)->first();

            if ($job_post_application != null) {
                // if job post application exists

                DB::beginTransaction();

                $job_offer = new JobOffer();
                $job_offer->job_offer_status_id = JobOfferStatus::$PENDING;
                $job_offer->job_post_application_id = $job_post_application_id;
                $job_offer->job_post_id = $job_post_application->job_post_id;
                $job_offer->company_id = $job_post_application->jobPost->employer->company_id;
                $job_offer->employer_id = $job_post_application->jobPost->employer->id;
                $job_offer->employee_id = $job_post_application->employee_id;
                $job_offer->description = $description;
                $job_offer->date_due = $date_due;
                $job_offer->save();

                $job_post_application->job_post_application_status_id = JobPostApplicationStatus::$SENT_JOB_OFFER;
                $job_post_application->save();

                DB::commit();

                $data = array();
                $data['job_offer'] = $job_offer;

                $response['data'] = $data;
                $response['message'] = 'Job offer sent.';
                $response['status_code'] = Response::HTTP_OK;
            } else {
                // if job post application is not found

                $error = array();
                $error['message'] = 'Job post application not found.';

                $response['error'] = $error;
                $response['message'] = 'Failed to send job offer.';
                $response['status_code'] = Response::HTTP_BAD_REQUEST;
            }
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error_code = $exception->errorInfo[1];
            Log::error($error_code);

            if ($error_code == 1062) {
                $error = array();
                $error['message'] = 'A job offer has already been sent.';

                $response['error'] = $error;
                $response['message'] = 'Failed to send job offer.';
                $response['status_code'] = Response::HTTP_BAD_REQUEST;
            } else {
                $error = array();
                $error['message'] = 'Query exception occurred.';

                $response['error'] = $error;
                $response['message'] = 'Failed to send job offer.';
                $response['status_code'] = Response::HTTP_BAD_REQUEST;
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to sent job offer.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }

    public static function acceptJobOffer($job_offer_id, $employee_id)
    {
        $response = array();

        try {
            $job_offer = JobOffer::where('id', $job_offer_id)->first();
            if ($job_offer != null) {
                // if job offer exists

                DB::beginTransaction();

                $company_id = $job_offer->jobPostApplication->jobPost->employer()->company;

                $job_offer->job_offer_status_id = JobOfferStatus::$ACCEPTED;
                $job_offer->save();

                $job_post_application = JobPostApplication::where('id', $job_offer->job_post_application_id)->first();
                $job_post_application->job_post_application_status_id = JobPostApplicationStatus::$HIRED;
                $job_post_application->save();

                $employee_company_history = new EmployeeCompanyHistory();
                $employee_company_history->employee_id = $employee_id;
                $employee_company_history->company_id = $company_id;
                $employee_company_history->save();

                DB::commit();

                $job_post_application['job_offer'] = $job_offer;

                $data = array();
                $data['job_post_application'] = $job_post_application;
                $data['employee_company_history'] = $employee_company_history;

                $response['data'] = $data;
                $response['message'] = 'Job offer successfully accepted.';
                $response['status_code'] = Response::HTTP_OK;
            } else {
                // if job offer does not exist

                $error = array();
                $error['message'] = 'Job offer not found.';

                $response['error'] = $error;
                $response['message'] = 'Failed to accept job offer.';
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
            $response['message'] = 'Failed to accept job offer.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to accept job offer.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }

    public static function declineJobOffer($job_offer_id)
    {
        $response = array();

        try {
            $job_offer = JobOffer::where('id', $job_offer_id)->first();
            if ($job_offer != null) {
                // if job offer exists

                DB::beginTransaction();

                $job_offer->job_offer_status_id = JobOfferStatus::$REJECTED;
                $job_offer->save();

                DB::commit();

                $data = array();
                $data['job_offer'] = $job_offer;

                $response['data'] = $data;
                $response['message'] = 'Job offer successfully declined.';
                $response['status_code'] = Response::HTTP_OK;
            } else {
                // if job offer does not exist

                $error = array();
                $error['message'] = 'Job offer not found.';

                $response['error'] = $error;
                $response['message'] = 'Failed to decline job offer.';
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
            $response['message'] = 'Failed to decline job offer.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to decline job offer.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }
}
