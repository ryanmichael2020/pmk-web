<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebEmployeeManagementController extends Controller
{
    public function displayListPage() {
        return view('admin.employee.manage_employees');
    }
}
