<?php

namespace App\Http\Controllers\Core\Login;

use App\Http\Controllers\Controller;
use App\Models\Login\DailyLoginHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DailyLoginHistoryController extends Controller
{
    public static function createDailyLoginHistory($user_id, $user_type_id)
    {
        $success = false;

        $daily_login_history_check = DailyLoginHistory::where('user_id', $user_id)
            ->whereDate('created_at', Carbon::now()->format('Y-m-d'))
            ->get();

        if (count($daily_login_history_check) == 0) {
            DB::beginTransaction();

            $daily_login_history = new DailyLoginHistory();
            $daily_login_history->user_id = $user_id;
            $daily_login_history->user_type_id = $user_type_id;
            $daily_login_history->save();

            DB::commit();

            $success = true;
        } else {
            $success = true;
        }

        return $success;
    }
}
