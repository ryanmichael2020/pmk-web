<?php

namespace App\Http\Controllers\Core\Auth;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\User\UserDetail;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public static function login($email, $password)
    {
        $response = array();

        try {
            $user = User::where('email', $email)->first();
            if ($user != null) { // if user is found
                if (Hash::check($password, $user->password)) { // if password matches
                    Auth::login($user);

                    $data = array();
                    $data['user'] = $user;

                    $response['data'] = $data;
                    $response['message'] = 'Login successful.';
                    $response['status_code'] = Response::HTTP_OK;
                } else { // if password does not match
                    $error = array();
                    $error['message'] = 'Invalid email/password.';

                    $response['error'] = $error;
                    $response['message'] = 'Login failed.';
                    $response['status_code'] = Response::HTTP_BAD_REQUEST;
                }
            } else {
                $error = array();
                $error['message'] = 'Invalid email/password.';

                $response['error'] = $error;
                $response['message'] = 'Login failed.';
                $response['status_code'] = Response::HTTP_BAD_REQUEST;
            }
        } catch (\Exception $exception) {
            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Login failed.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }

    public static function signup($email, $password, $verify_password, $first_name, $last_name, $sex)
    {
        $response = array();

        try {
            if ($password == $verify_password) {
                DB::beginTransaction();

                $user = new User();
                $user->email = $email;
                $user->password = Hash::make($password);
                $user->user_type_id = 3; // user type - employee
                $user->save();

                $userDetail = new UserDetail();
                $userDetail->user_id = $user->id;
                $userDetail->first_name = $first_name;
                $userDetail->last_name = $last_name;
                $userDetail->sex = $sex;
                $userDetail->save();

                DB::commit();

                $data = array();
                $data['user'] = $user;
                $data['user']['user_detail'] = $userDetail;

                $response['data'] = $data;
                $response['message'] = 'Signup successful.';
                $response['status_code'] = Response::HTTP_OK;
            } else {
                $error = array();
                $error['message'] = 'Passwords do not match.';

                $response['error'] = $error;
                $response['message'] = 'Signup failed.';
                $response['status_code'] = Response::HTTP_BAD_REQUEST;
            }
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());
            $error_code = $exception->errorInfo[1];

            Log::error($error_code);
            if ($error_code == 1062) {
                $error = array();
                $error['message'] = 'This email is already in use. Please use a different email.';

                $response['error'] = $error;
                $response['message'] = ' Signup failed.';
            } else {
                $error = array();
                $error['message'] = 'Query exception occurred.';

                $response['error'] = $error;
                $response['message'] = ' Signup failed.';
                $response['status_code'] = Response::HTTP_BAD_REQUEST;
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = ' Signup failed.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }
}