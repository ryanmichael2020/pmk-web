<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Auth\AuthController;
use App\Http\Requests\Auth\AuthForgotPasswordRequest;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthResetPasswordRequest;
use App\Http\Requests\Auth\AuthSignupRequest;
use App\Models\User\UserType;
use Illuminate\Http\Response;

class WebAuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;

        $response = AuthController::login($email, $password);
        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);

            $user_type_id = $response['data']['user']['user_type_id'];
            if ($user_type_id == UserType::$ADMIN) {
                return redirect('/admin/dashboard');
            } else if ($user_type_id == UserType::$EMPLOYER) {
                return redirect('/employer/dashboard');
            } else {
                return redirect('/dashboard');
            }
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);

            return redirect()->back();
        }
    }

    public function forgotPassword(AuthForgotPasswordRequest $request)
    {
        $email = $request->email;

        $response = AuthController::sendPasswordResetEmail($email);

        if ($response['status_code'] >= 200 && $response['status_code'] < 300) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);
        }

        return redirect()->back();
    }

    public function resetPassword(AuthResetPasswordRequest $request)
    {
        $user_id = base64_decode($request->user_id);
        $password = $request->password;
        $verify_password = $request->verify_password;

        $response = AuthController::resetPassword($user_id, $password, $verify_password);

        if ($response['status_code'] >= 200 && $response['status_code'] < 300) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);
            return redirect('/login');
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);
            return redirect()->back();
        }
    }

    public function signup(AuthSignupRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $verify_password = $request->verify_password;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $sex = $request->sex;
        $image = $request->image;

        $response = AuthController::signup($email, $password, $verify_password, $first_name, $last_name, $sex, $image);

        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);

            return redirect('/login');
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);

            return redirect()->back();
        }
    }

    public function logout()
    {
        $response = AuthController::logout();

        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);

            return redirect('/');
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);

            return redirect()->back();
        }
    }
}
