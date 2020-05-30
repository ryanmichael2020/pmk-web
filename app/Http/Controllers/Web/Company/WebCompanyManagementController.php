<?php

namespace App\Http\Controllers\Web\Company;

use App\Http\Controllers\Controller;

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
}
