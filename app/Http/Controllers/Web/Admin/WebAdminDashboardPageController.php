<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebAdminDashboardPageController extends Controller
{
    public function displayDashboardPage() {
        return view('admin.dashboard');
    }
}
