<?php

namespace App\Http\Controllers\Web\JobPost;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebJobPostManagementController extends Controller
{
    public function displayListPage()
    {
        return view('admin.employer.manage_jobpost');
    }
    public function displayCreatePage()
    {
        return view('admin.employer.create_jobpost');
    }
}
