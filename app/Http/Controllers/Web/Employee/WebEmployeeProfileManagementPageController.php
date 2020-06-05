<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeEducation;
use App\Models\Employee\EmployeeSkill;
use App\Models\User\User;

class WebEmployeeProfileManagementPageController extends Controller
{
    public function displayProfileDashboardPage()
    {
        return view('employee.profile.dashboard');
    }

    public function displayProfileAccountUpdatePage()
    {
        $user_id = auth()->user()->id;
        $user = User::with('userDetail')->where('id', $user_id)->first();

        return view('employee.profile.update_account')
            ->with('user', $user);
    }

    public function displayProfileDetailsUpdatePage()
    {
        $user_id = auth()->user()->id;
        $employee = Employee::where('user_id', $user_id)->first();

        return view('employee.profile.update_details')->with('employee', $employee);
    }

    public function displayProfileEducationManagementPage()
    {
        $employee_id = auth()->user()->employee->id;
        $employee_educations = EmployeeEducation::where('employee_id', $employee_id)
            ->orderBy('created_at', 'desc')->get();

        return view('employee.profile.manage_education')->with('employee_educations', $employee_educations);
    }

    public function displayProfileEducationCreatePage()
    {
        return view('employee.profile.add_education');
    }

    public function displayProfileSkillsUpdatePage()
    {
        $employee_id = auth()->user()->employee->id;
        $employee_skills = EmployeeSkill::where('employee_id', $employee_id)
            ->orderBy('skill', 'desc')->get()->pluck('skill')->toArray();

        $employee_skills_imploded = implode(",", $employee_skills);

        return view('employee.profile.update_skills')
            ->with('employee_skills', $employee_skills)
            ->with('employee_skills_imploded', $employee_skills_imploded);
    }
}
