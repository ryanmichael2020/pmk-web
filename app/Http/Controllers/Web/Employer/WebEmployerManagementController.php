<?php

namespace App\Http\Controllers\Web\Employer;

use App\Http\Controllers\Controller;
use App\Models\Company\Company;

class WebEmployerManagementController extends Controller
{
    public function displayListPage()
    {
        return view('admin.employer.manage_employers');
    }
    public function displayCreatePage()
    {
        $company = Company::all();
        return view('admin.employer.create_employer')
            ->with('company', $company);;
    }
}
