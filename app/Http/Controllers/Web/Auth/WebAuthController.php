<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Auth\AuthController;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthSignupRequest;
use App\Models\User\UserType;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

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

    public function signup(AuthSignupRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $verify_password = $request->verify_password;
        $image = $request->image;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $sex = $request->sex;

        $response = AuthController::signup($email, $password, $verify_password, $image, $first_name, $last_name, $sex);

        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);

            return redirect('/signup');
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
