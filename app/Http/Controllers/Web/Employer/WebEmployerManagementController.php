<?php

namespace App\Http\Controllers\Web\Employer;

use App\Http\Controllers\Controller;

class WebEmployerManagementController extends Controller
{
    public function displayListPage()
    {
        return view('admin.employer.manage_employer');
    }
    public function displayCreatePage()
    {
        return view('admin.employer.create_employer');
    }
}
