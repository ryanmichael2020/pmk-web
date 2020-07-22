<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employer\Employer;
use App\Models\JobPost\JobPostApplication;
use App\Models\JobPost\JobPostApplicationStatus;
use App\Models\Login\DailyLoginHistory;
use App\Models\User\User;
use App\Models\User\UserType;

class WebAdminDashboardPageController extends Controller
{
    public function displayDashboardPage()
    {
        $daily_login_total = DailyLoginHistory::where('user_type_id', '!=', UserType::$ADMIN)->count();
        $daily_login_admin = DailyLoginHistory::where('user_type_id', UserType::$ADMIN)->count();
        $daily_login_employer = DailyLoginHistory::where('user_type_id', UserType::$EMPLOYER)->count();
        $daily_login_employee = DailyLoginHistory::where('user_type_id', UserType::$EMPLOYEE)->count();

        $admin_total = User::where('user_type_id', UserType::$ADMIN)->count();
        $employer_total = Employer::count();
        $employee_total = Employee::count();
        $user_total = User::where('user_type_id', '!=', UserType::$ADMIN)->count();

        $job_applications_submitted = JobPostApplication::count();
        $job_applications_accepted = JobPostApplication::where('job_post_application_status_id', JobPostApplicationStatus::$HIRED)->count();
        $job_applications_rejected = JobPostApplication::where('job_post_application_status_id', JobPostApplicationStatus::$REJECTED)->count();


        return view('admin.dashboard')
            ->with('daily_login_total', $daily_login_total)
            ->with('daily_login_admin', $daily_login_admin)
            ->with('daily_login_employer', $daily_login_employer)
            ->with('daily_login_employee', $daily_login_employee)
            ->with('admin_total', $admin_total)
            ->with('employer_total', $employer_total)
            ->with('employee_total', $employee_total)
            ->with('user_total', $user_total)
            ->with('job_applications_submitted', $job_applications_submitted)
            ->with('job_applications_accepted', $job_applications_accepted)
            ->with('job_applications_rejected', $job_applications_rejected);
    }
}
