<?php

namespace App\Http\Controllers\Core\User;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\User\UserDetail;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public static function update($user_id, $email, $first_name, $last_name, $sex, $password = null, $verify_password = null, $image = null)
    {
        try {
            $user = User::where('id', $user_id)->first();

            if ($user != null) {
                // if employee exists
                $user_detail = UserDetail::where('user_id', $user_id)->first();

                DB::beginTransaction();

                $user->email = $email;

                if ($password != null && $verify_password != null) {
                    if ($password == $verify_password) {
                        $user->password = Hash::make($password);
                    } else {
                        $error = array();
                        $error['message'] = 'Passwords do not match.';

                        $response['error'] = $error;
                        $response['message'] = 'Failed to update account.';
                        $response['status_code'] = Response::HTTP_BAD_REQUEST;

                        return $response;
                    }
                }

                $user->save();

                if ($image != null) {
                    $image_path = public_path() . '/images/profile_pictures';
                    $image_extension = $image->extension();
                    $image_name = uniqid() . '.' . $image_extension;
                    $image->move($image_path, $image_name);

                    // image path stored in database
                    $image_public_path = '/images/profile_pictures/' . $image_name;
                    $user_detail->image = $image_public_path;
                }

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

    public static function suspendAccount($user_id)
    {
        $response = [];

        try {
            DB::beginTransaction();

            $user = User::where('id', $user_id)->first();

            if ($user != null) {
                $user->delete();

                DB::commit();

                $response['message'] = 'Account successfully suspended.';
                $response['status_code'] = Response::HTTP_OK;
            } else {
                $error = [
                    'message' => 'Invalid user provided.',
                ];

                $response['error'] = $error;
                $response['message'] = 'Failed to suspend account.';
                $response['status_code'] = Response::HTTP_BAD_REQUEST;
            }

            DB::commit();
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Query exception occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to suspend account.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to suspend account.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }

    public static function restoreAccount($user_id)
    {
        $response = [];

        try {
            DB::beginTransaction();

            $user = User::where('id', $user_id)
                ->withTrashed()
                ->first();

            if ($user != null) {
                $user->restore();

                DB::commit();

                $response['message'] = 'Account successfully restored.';
                $response['status_code'] = Response::HTTP_OK;
            } else {
                $error = [
                    'message' => 'Invalid user provided.',
                ];

                $response['error'] = $error;
                $response['message'] = 'Failed to restore account.';
                $response['status_code'] = Response::HTTP_BAD_REQUEST;
            }

            DB::commit();
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Query exception occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to restore account.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to restore account.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }
}
