<?php

namespace App\Http\Controllers\Core\Employer;

use App\Http\Controllers\Controller;
use App\Models\Employer\Employer;
use App\Models\User\User;
use App\Models\User\UserDetail;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployerController extends Controller
{
    public static function create($email, $password, $verify_password, $first_name, $last_name, $sex, $company_id)
    {
        $response = array();

        try {
            if ($password == $verify_password) {
                // if passwords match
                DB::beginTransaction();

                $user = new User();
                $user->email = $email;
                $user->password = $password;
                $user->user_type_id = 1;
                $user->save();

                $user_detail = new UserDetail();
                $user_detail->first_name = $first_name;
                $user_detail->last_name = $last_name;
                $user_detail->sex = $sex;
                $user_detail->save();

                $employer = new Employer();
                $employer->company_id = $company_id;
                $employer->user_id = $user->id;
                $employer->save();

                DB::commit();

                $data = array();
                $data['user'] = $user;
                $data['user']['user_details'] = $user_detail;
                $data['user']['employer'] = $employer;

                $response['data'] = $data;
                $response['message'] = 'Employer created successfully.';
                $response['status_code'] = Response::HTTP_OK;
            } else {
                // if passwords do not match
                $error = array();
                $error['message'] = 'Passwords do not match.';

                $response['error'] = $error;
                $response['message'] = 'Failed to create employer.';
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
            $response['message'] = ' Failed to create employer.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = ' Failed to create employer.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }
}
