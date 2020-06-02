<?php

namespace App\Http\Controllers\Core\Employer;

use App\Http\Controllers\Controller;
use App\Models\Employer\Employer;
use App\Models\User\User;
use App\Models\User\UserDetail;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployerController extends Controller
{
    public static function create($email, $password, $verify_password,$first_name, $last_name, $sex, $company_id)
    {
        $response = array();

        try {
            DB::beginTransaction();
            if ($password == $verify_password) {

                $user = new User();
                $user->email = $email;
                $user->password = $password;
                $user->user_type_id = 1;
                $user->save();

                $employer = new Employer();
                $employer->company_id = $company_id;
                $employer->user_id = 5;
                $employer->save();

                $user_details = new UserDetail();
                $user_details->first_name = $first_name;
                $user_details->last_name = $last_name;
                $user_details->sex = $sex;
                $user_id = 5;

                DB::commit();

                $data = array();
                $data['user'] = $user;
                $data['employer'] = $employer;
                $data['user_details'] = $user_details;
                $response['data'] = $data;
                $response['message'] = 'Employer created successfully.';
                $response['status_code'] = Response::HTTP_OK;
            }
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error_code = $exception->errorInfo[1];
            Log::error($error_code);

            if ($error_code == 1062) {
                $error = array();
                $error['message'] = 'Employer name already exists.';

                $response['error'] = $error;
                $response['message'] = ' Failed to create company.';
            } else {
                $error = array();
                $error['message'] = 'Query exception occurred.';

                $response['error'] = $error;
                $response['message'] = ' Failed to create company.';
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
