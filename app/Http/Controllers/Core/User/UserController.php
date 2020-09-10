<?php

namespace App\Http\Controllers\Core\User;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\User\UserDetail;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public static function update($user_id, $email, $first_name, $last_name, $sex)
    {
        try {
            $user = User::where('id', $user_id)->first();

            if ($user != null) {
                // if employee exists
                $user_detail = UserDetail::where('user_id', $user_id)->first();

                DB::beginTransaction();

                $user->email = $email;
                $user->save();

                $user_detail->first_name = $first_name;
                $user_detail->last_name = $last_name;
                $user_detail->sex = $sex;
                $user_detail->save();

                DB::commit();

                $data = array();
                $data['user'] = $user;
                $data['user']['user_detail'] = $user_detail;

                $response['data'] = $data;
                $response['message'] = 'Account successfully updated.';
                $response['status_code'] = Response::HTTP_OK;
            } else {
                // if employee does not exist
                $error = array();
                $error['message'] = 'User not found.';

                $response['error'] = $error;
                $response['message'] = 'Failed to update account.';
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
                $response['message'] = 'Failed to update account.';
                $response['status_code'] = Response::HTTP_BAD_REQUEST;
            } else {
                $error = array();
                $error['message'] = 'Query exception occurred.';

                $response['error'] = $error;
                $response['message'] = 'Failed to update account.';
                $response['status_code'] = Response::HTTP_BAD_REQUEST;
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to update account.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }
}
