<?php

namespace App\Http\Controllers\Web\Employer;

use App\Http\Controllers\Controller;

class WebEmployerManagementController extends Controller
{
    public function displayCreatePage()
    {
        return view('admin.employer.create_employer');
    }
}
