<?php

namespace App\Http\Controllers\Core\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Login\DailyLoginHistoryController;
use App\Models\Employee\Employee;
use App\Models\User\User;
use App\Models\User\UserDetail;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public static function login($email, $password)
    {
        $response = array();

        try {
            $user = User::with('userType', 'userDetail')
                ->where('email', $email)
                ->first();
            if ($user != null) { // if user is found
                if (Hash::check($password, $user->password)) { // if password matches
                    auth()->login($user);
                    DailyLoginHistoryController::createDailyLoginHistory($user->id, $user->user_type_id);

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

    public static function signup($email, $password, $verify_password, $first_name, $last_name, $sex, $image = null)
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

                $user_detail = new UserDetail();
                $user_detail->user_id = $user->id;
                $user_detail->first_name = $first_name;
                $user_detail->last_name = $last_name;
                $user_detail->sex = $sex;

                if ($image != null) {
                    $image_path = public_path() . '/images/profile_pictures';
                    $image_extension = $image->extension();
                    $image_name = uniqid() . '.' . $image_extension;
                    $image->move($image_path, $image_name);

                    // image path stored in database
                    $image_public_path = '/images/profile_pictures/' . $image_name;
                    $user_detail->image = $image_public_path;
                } else {
                    $user_detail->image = (strtolower($sex) == 'male') ? 'images/profile_pictures/man.png' : 'images/profile_pictures/woman.png';
                }
                $user_detail->save();

                $employee = new Employee();
                $employee->user_id = $user->id;
                $employee->save();

                DB::commit();

                $data = array();
                $data['user'] = $user;
                $data['user']['user_detail'] = $user_detail;

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
                $response['message'] = 'Signup failed.';
                $response['status_code'] = Response::HTTP_BAD_REQUEST;
            } else {
                $error = array();
                $error['message'] = 'Query exception occurred.';

                $response['error'] = $error;
                $response['message'] = 'Signup failed.';
                $response['status_code'] = Response::HTTP_BAD_REQUEST;
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Signup failed.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }

    public static function logout()
    {
        $response = array();

        try {
            auth()->logout();

            $response['message'] = 'Logout successful.';
            $response['status_code'] = Response::HTTP_OK;
        } catch (\Exception $exception) {
            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Logout failed.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }
}
