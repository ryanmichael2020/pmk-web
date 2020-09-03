<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Employee\EmployeeController;
use App\Http\Controllers\Core\Employee\EmployeeEducationController;
use App\Http\Controllers\Core\Employee\EmployeeReviewController;
use App\Http\Controllers\Core\Employee\EmployeeSkillController;
use App\Http\Controllers\Core\Employee\EmployeeTrainingController;
use App\Http\Controllers\Core\User\UserController;
use App\Http\Requests\Employee\CreateEmployeeEducationRequest;
use App\Http\Requests\Employee\CreateEmployeeReviewRequest;
use App\Http\Requests\Employee\CreateEmployeeTrainingRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeSkillsRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class WebEmployeeProfileManagementController extends Controller
{
    public function updateEmployeeAccount(UpdateUserRequest $request)
    {
        $email = $request->email;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $sex = $request->sex;

        $user_id = auth()->user()->id;

        $response = UserController::update($user_id, $email, $first_name, $last_name, $sex);
        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);
        }

        return redirect()->back();
    }

    public function updateEmployeeDetails(UpdateEmployeeRequest $request)
    {
        $age = $request->age;
        $address = $request->address;
        $mobile = $request->mobile;

        $employee_id = auth()->user()->employee->id;

        $response = EmployeeController::update($employee_id, $age, $address, $mobile);
        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);
            return redirect('/profile');
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);
            return redirect()->back();
        }
    }

    public function addEmployeeEducation(CreateEmployeeEducationRequest $request)
    {
        $education_level_id = $request->education_level_id;
        $school = $request->school;
        $start_year = $request->start_year;
        $end_year = isset($request->end_year) ? $request->end_year : null;

        $employee_id = auth()->user()->employee->id;

        $response = EmployeeEducationController::create($employee_id, $school, $education_level_id, $start_year, $end_year);
        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);
        }

        return redirect('/profile/educations/management');
    }

    public function updateSkills(UpdateEmployeeSkillsRequest $request)
    {
        $skills = $request->skills;
        $skills_list = explode(',', $skills);
        $employee_id = auth()->user()->employee->id;

        $response = EmployeeSkillController::update($employee_id, $skills_list);
        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);
        }

        return redirect('/profile/skills/update');
    }

    public function addTraining(CreateEmployeeTrainingRequest $request)
    {
        $training = $request->training;
        $month = $request->month;
        $year = $request->year;
        $employee_id = auth()->user()->employee->id;

        $response = EmployeeTrainingController::create($employee_id, $training, $month, $year);
        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);
        }

        return redirect('/profile/trainings/management');
    }

    public function addRating(CreateEmployeeReviewRequest $request)
    {
        $company_id = $request->company_id;
        $employee_id = $request->employee_id;
        $punctuality_score = $request->punctuality_score;
        $performance_score = $request->performance_score;
        $personality_score = $request->personality_score;

        $response = EmployeeReviewController::createReview($company_id, $employee_id, $punctuality_score, $performance_score, $personality_score);
        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);
        }

        return redirect()->back();
    }
}
