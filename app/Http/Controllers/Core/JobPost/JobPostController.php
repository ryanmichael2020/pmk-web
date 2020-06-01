<?php

namespace App\Http\Controllers\Core\JobPost;

use App\Http\Controllers\Controller;
use App\Models\Employer\Employer;
use App\Models\JobPost\JobPost;
use App\Models\User\User;
use App\Models\User\UserDetail;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
    public static function create($position, $description, $max_applicants)
    {
        $response = array();

        try {
            DB::beginTransaction();

                $jobPost = new JobPost();
                $jobPost->postion = $position;
                $jobPost->description = $description;
                $jobPost->max_applicants = $max_applicants;
                $jobPost->save();


                DB::commit();

                $data = array();
                $data['jobPost'] = $jobPost;
                $response['data'] = $data;
                $response['message'] = 'Job Post created successfully.';
                $response['status_code'] = Response::HTTP_OK;

        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());
            $error_code = $exception->errorInfo[1];

            Log::error($error_code);
            if ($error_code == 1062) {
                $error = array();
                $error['message'] = 'Job Post already exists.';

                $response['error'] = $error;
                $response['message'] = ' Failed to create job post.';
            } else {
                $error = array();
                $error['message'] = 'Query exception occurred.';

                $response['error'] = $error;
                $response['message'] = ' Failed to create job post.';
                $response['status_code'] = Response::HTTP_BAD_REQUEST;
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = ' Failed to create company.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }
}
