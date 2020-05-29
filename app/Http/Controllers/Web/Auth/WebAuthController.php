<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Auth\AuthController;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthSignupRequest;
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

            Log::debug($response);
            // TODO :: Update redirect based on user type
            return redirect('/dashboard');
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

        $response = AuthController::signup($email, $password, $verify_password, $first_name, $last_name, $sex);
        Log::debug($response);

        if ($response['status_code'] = Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);

            return redirect('/signup');
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);

            return redirect()->back();
        }
    }
}
