<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\User\UserController;
use Illuminate\Http\Request;

class WebUserController extends Controller
{
    public function suspend(Request $request)
    {
        $user_id = $request->user_id;

        $response = UserController::suspendAccount($user_id);
        if ($response['status_code'] >= 200 && $response['status_code'] < 300) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);
        }

        return redirect()->back();
    }

    public function restore(Request $request)
    {
        $user_id = $request->user_id;

        $response = UserController::restoreAccount($user_id);
        if ($response['status_code'] >= 200 && $response['status_code'] < 300) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);
        }

        return redirect()->back();
    }
}
