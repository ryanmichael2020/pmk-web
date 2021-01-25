<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeEducation;
use App\Models\Employee\EmployeeReview;
use App\Models\Employee\EmployeeSkill;
use App\Models\Employee\EmployeeTraining;
use App\Models\JobPost\JobPost;
use App\Models\JobPost\JobPostApplication;
use App\Models\User\User;
use App\Models\User\UserType;

class WebEmployeeProfileManagementPageController extends Controller
{
    public function displayProfilePeekPage($employee_id)
    {
        $employee = Employee::where('id', $employee_id)->first();
        $user = User::where('id', $employee->user_id)->first();

        return view('employee.profile.profile_peek')
            ->with('user', $user)
            ->with('employee', $employee);
    }

    public function displayProfileReviewPage($employee_id)
    {
        $employee = Employee::where('id', $employee_id)->first();
        $employee_reviews = EmployeeReview::where('employee_id', $employee_id)
            ->orderBy('created_at', 'desc')
            ->get();

        $job_post_application_ids = JobPostApplication::where('employee_id', $employee_id)->get()->pluck('job_post_id');
        $job_posts = JobPost::whereIn('id', $job_post_application_ids)
            ->get();

        foreach ($job_posts as $job_post_key => $job_post) {
            foreach ($employee_reviews as $employee_review_key => $employee_review) {
                if ($job_post->id == $employee_review->job_post_id) {
                    unset($job_posts[$job_post_key]);
                }
            }
        }

        $can_create_review = false;
        if (auth()->user()->user_type_id == UserType::$EMPLOYER) {
            $employer_company_id = auth()->user()->employer->company_id;
            $employee_reviews_from_company = EmployeeReview::where('employee_id', $employee_id)
                ->where('company_id', $employer_company_id)
                ->get();

            if (count($employee_reviews_from_company) < 1 && $employee->company_id == $employer_company_id) {
                $can_create_review = true;
            } else if (count($job_posts) > 0) {
                $can_create_review = true;
            }
        }

        // TODO :: Allow employee review for admin

        return view('employee.profile.view_employee_reviews')
            ->with('job_posts', $job_posts)
            ->with('employee', $employee)
            ->with('employee_reviews', $employee_reviews)
            ->with('can_create_review', $can_create_review);
    }

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
            ->get()->pluck('skill')->toArray();

        $employee_skills_imploded = implode(",", $employee_skills);

        return view('employee.profile.update_skills')
            ->with('employee_skills', $employee_skills)
            ->with('employee_skills_imploded', $employee_skills_imploded);
    }

    public function displayProfileTrainingsManagementPage()
    {
        $employee_id = auth()->user()->employee->id;
        $employee_trainings = EmployeeTraining::where('employee_id', $employee_id)
            ->orderBy('year', 'desc')->get();

        return view('employee.profile.manage_trainings')
            ->with('employee_trainings', $employee_trainings);
    }

    public function displayProfileTrainingCreatePage()
    {
        return view('employee.profile.add_training');
    }
}
