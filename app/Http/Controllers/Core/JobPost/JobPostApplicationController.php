<?php

namespace App\Http\Controllers\Core\JobPost;

use App\Http\Controllers\Controller;
use App\Models\JobPost\JobPost;
use App\Models\JobPost\JobPostApplication;
use App\Models\JobPost\JobPostApplicationStatus;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class JobPostApplicationController extends Controller
{
    public static function create($job_post_id, $employee_id)
    {
        $response = array();

        try {
            DB::beginTransaction();

            $job_post_application = new JobPostApplication();
            $job_post_application->job_post_id = $job_post_id;
            $job_post_application->employee_id = $employee_id;
            $job_post_application->job_post_application_status_id = JobPostApplicationStatus::$PENDING;
            $job_post_application->save();

            DB::commit();

            $data = array();
            $data['job_post_application'] = $job_post_application;

            $response['data'] = $data;
            $response['message'] = 'Job post application successfully created.';
            $response['status_code'] = Response::HTTP_OK;
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error_code = $exception->errorInfo[1];
            Log::error($error_code);

            $error = array();
            $error['message'] = 'Query exception occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to create job post application.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to create job post application.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }

    public static function update($job_post_application_id, $job_post_id, $employee_id, $job_post_application_status_id = null)
    {
        $response = array();

        try {
            $job_post_application = JobPostApplication::where('id', $job_post_application_id)->first();

            if ($job_post_application != null) {
                // if job post application exists
                DB::beginTransaction();

                $job_post_application->job_post_id = $job_post_id;
                $job_post_application->employee_id = $employee_id;

                // TODO :: Add validation to prevent adding more applicants if max (approved) applicants has been reached
                if ($job_post_application_status_id != null) {
                    $job_post_application->job_post_application_status_id = $job_post_application_status_id;

                    if ($job_post_application_status_id == JobPostApplicationStatus::$ACCEPTED) {
                        $job_post = JobPost::where('id', $job_post_application->job_post_id)->first();

                        $job_post->approved_applications++;
                        $job_post->save();
                    }
                }

                $job_post_application->save();

                DB::commit();

                $data = array();
                $data['job_post_application'] = $job_post_application;

                $response['data'] = $data;
                $response['message'] = 'Job post application successfully updated.';
                $response['status_code'] = Response::HTTP_OK;
            } else {
                // if job post application does not exist
                $error = array();
                $error['message'] = 'Job post application not found.';

                $response['error'] = $error;
                $response['message'] = 'Failed to update job post application.';
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
            $response['message'] = 'Failed to update job post application.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to update job post application.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }

    public static function updateEmployeeApplicationStatus($job_post_application_id, $employee_id, $job_post_application_status_id)
    {
        $response = array();

        try {
            $job_post_application = JobPostApplication::where('id', $job_post_application_id)
                ->where('employee_id', $employee_id)->first();

            if ($job_post_application != null) {
                // if employee job post application exists
                DB::beginTransaction();

                $job_post_application->job_post_application_status_id = $job_post_application_status_id;
                $job_post_application->save();

                DB::commit();

                $data = array();
                $data['job_post_application'] = $job_post_application;

                $response['data'] = $data;
                $response['message'] = 'Job post application successfully updated.';
                $response['status_code'] = Response::HTTP_OK;
            } else {
                // if employee job application does not exist
                $error = array();
                $error['message'] = 'Employee job application not found.';

                $response['error'] = $error;
                $response['message'] = 'Failed to update job post application.';
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
            $response['message'] = 'Failed to update job post application.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to update job post application.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }

    public static function delete($job_post_application_id)
    {
        $response = array();

        try {
            $job_post_application = JobPostApplication::where('id', $job_post_application_id)->first();

            if ($job_post_application != null) {
                // if job post application exists
                DB::beginTransaction();

                $job_post_application->delete();

                DB::commit();

                $response['message'] = 'Job post application successfully deleted.';
                $response['status_code'] = Response::HTTP_OK;
            } else {
                // if job post application does not exist
                $error = array();
                $error['message'] = 'Job post application not found.';

                $response['error'] = $error;
                $response['message'] = 'Failed to delete job application.';
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
            $response['message'] = 'Failed to delete job post application.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to delete job post application.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }
}
