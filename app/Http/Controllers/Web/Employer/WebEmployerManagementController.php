<?php

namespace App\Http\Controllers\Web\Employer;

use App\Http\Controllers\Controller;
use App\Models\Company\Company;
use App\Models\Employer\Employer;

class WebEmployerManagementController extends Controller
{
    public function displayListPage()
    {
        return view('admin.employer.manage_employers');
    }

    public function displayCreatePage()
    {
        $companies = Company::all();
        return view('admin.employer.create_employer')
            ->with('companies', $companies);;
    }

    public function displayUpdatePage($employer_id)
    {
        $companies = Company::all();
        $employer = Employer::where('id', $employer_id)
            ->first();

        return view('admin.employer.update_employer')
            ->with('companies', $companies)
            ->with('employer', $employer);
    }

    public function displayViewPage($employer_id)
    {
        $employer = Employer::where('id', $employer_id)
            ->first();

        return view('admin.employer.view_employer')
            ->with('employer', $employer);
    }
}
