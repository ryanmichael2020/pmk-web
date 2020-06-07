<?php

namespace App\Http\Controllers\Web\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\Company;

class WebCompanyManagementController extends Controller
{
    public function displayListPage()
    {
        return view('admin.company.manage_companies');
    }

    public function displayCreatePage()
    {
        return view('admin.company.create_company');
    }

    public function displayUpdatePage($company_id)
    {
        $company = Company::where('id', $company_id)->first();

        return view('admin.company.update_company')
            ->with('company', $company);
    }

    public function displayViewPage($company_id)
    {
        $company = Company::where('id', $company_id)->first();

        return view('admin.company.view_company')
            ->with('company', $company);
    }
}
