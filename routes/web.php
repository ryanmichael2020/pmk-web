<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing_page');
});

// Auth Routes
Route::get('/login', 'Web\Auth\WebAuthPageController@displayLoginPage');
Route::get('/signup', 'Web\Auth\WebAuthPageController@displaySignupPage');
Route::get('/user/{user_id}/email/verify', 'Web\Auth\WebAuthPageController@verifyEmailPage')->name('user.verify.email');

Route::post('/login', 'Web\Auth\WebAuthController@login');
Route::post('/signup', 'Web\Auth\WebAuthController@signup');
Route::post('/logout', 'Web\Auth\WebAuthController@logout');

// ADMIN Routes
Route::get('/admin/dashboard', 'Web\Admin\WebAdminDashboardPageController@displayDashboardPage');

// ADMIN -- Company Routes
Route::get('/admin/management/companies', 'Web\Company\WebCompanyManagementController@displayListPage');
Route::get('/admin/management/companies/create', 'Web\Company\WebCompanyManagementController@displayCreatePage');
Route::get('/admin/management/company/{id}/update', 'Web\Company\WebCompanyManagementController@displayUpdatePage');
Route::get('/admin/management/company/{id}', 'Web\Company\WebCompanyManagementController@displayViewPage');

Route::get('/companies/datatable', 'Web\Company\WebCompanyController@getDataTable');
Route::post('/companies/create', 'Web\Company\WebCompanyController@create');
Route::post('/company/update', 'Web\Company\WebCompanyController@update');

// ADMIN -- Employer Routes

Route::get('/admin/management/employers', 'Web\Employer\WebEmployerManagementController@displayListPage');
Route::get('/admin/management/employers/create', 'Web\Employer\WebEmployerManagementController@displayCreatePage');
Route::get('/admin/management/employer/{id}/update', 'Web\Employer\WebEmployerManagementController@displayUpdatePage');
Route::get('/admin/management/employer/{id}', 'Web\Employer\WebEmployerManagementController@displayViewPage');

Route::get('/employers/datatable', 'Web\Employer\WebEmployerController@getDataTable');
Route::post('/employers/create', 'Web\Employer\WebEmployerController@create');
Route::post('/employer/update', 'Web\Employer\WebEmployerController@update');

Route::get('/admin/management/employees', 'Web\Employee\WebEmployeeManagementController@displayListPage');
Route::get('/admin/management/employee/{employee_id}/profile', 'Web\Employee\WebEmployeeManagementController@displayProfilePeekUnrelatedPage');

Route::get('/employees/datatable', 'Web\Employee\WebEmployeeController@getDataTable');
Route::get('/company/{company_id}/employees/datatable', 'Web\Employee\WebEmployeeController@getDataTableByCompanyId');
Route::post('/employee/dismiss', 'Web\Employee\WebEmployeeController@dismissEmployee');

// Employee Routes
Route::get('/dashboard', 'Web\Employee\WebEmployeeDashboardPageController@displayDashboardPage');

// Employee Profile Routes
Route::get('/employee/{employee_id}/profile', 'Web\Employee\WebEmployeeProfileManagementPageController@displayProfilePeekPage');

Route::get('/profile', 'Web\Employee\WebEmployeeProfileManagementPageController@displayProfileDashboardPage');
Route::get('/profile/account/update', 'Web\Employee\WebEmployeeProfileManagementPageController@displayProfileAccountUpdatePage');
Route::get('/profile/details/update', 'Web\Employee\WebEmployeeProfileManagementPageController@displayProfileDetailsUpdatePage');
Route::get('/profile/skills/update', 'Web\Employee\WebEmployeeProfileManagementPageController@displayProfileSkillsUpdatePage');

Route::get('/profile/educations/management', 'Web\Employee\WebEmployeeProfileManagementPageController@displayProfileEducationManagementPage');
Route::get('/profile/educations/add', 'Web\Employee\WebEmployeeProfileManagementPageController@displayProfileEducationCreatePage');

Route::get('/profile/trainings/management', 'Web\Employee\WebEmployeeProfileManagementPageController@displayProfileTrainingsManagementPage');
Route::get('/profile/trainings/add', 'Web\Employee\WebEmployeeProfileManagementPageController@displayProfileTrainingCreatePage');

Route::post('/profile/account/update', 'Web\Employee\WebEmployeeProfileManagementController@updateEmployeeAccount');
Route::post('/profile/details/update', 'Web\Employee\WebEmployeeProfileManagementController@updateEmployeeDetails');
Route::post('/profile/education/add', 'Web\Employee\WebEmployeeProfileManagementController@addEmployeeEducation');
Route::post('/profile/skills/update', 'Web\Employee\WebEmployeeProfileManagementController@updateSkills');
Route::post('/profile/trainings/add', 'Web\Employee\WebEmployeeProfileManagementController@addTraining');

// Employee Review Routes
Route::get('/employee/{employee_id}/reviews', 'Web\Employee\WebEmployeeProfileManagementPageController@displayProfileReviewPage');
Route::post('/employee/review/create', 'Web\Employee\WebEmployeeProfileManagementController@addRating');

// Job Post Routes (Employee)
Route::get('/job_posts', 'Web\Employee\JobPost\WebEmployeeJobPostManagementController@displayListPage');
Route::get('/job_post/{job_post_id}', 'Web\Employee\JobPost\WebEmployeeJobPostManagementController@displayJobPostPage');
Route::post('/job_posts/apply', 'Web\Employee\JobPost\WebEmployeeJobPostController@apply');

// Job Application Routes (Employee)
Route::get('/job_applications', 'Web\Employee\JobPostApplication\WebEmployeeJobPostApplicationManagementController@displayListPage');
Route::get('/job_application/{job_application_id}', 'Web\Employee\JobPostApplication\WebEmployeeJobPostApplicationManagementController@displayJobPostApplicationPage');
Route::post('/job_application/update', 'Web\Employee\JobPostApplication\WebEmployeeJobPostApplicationController@updateJobPostApplication');

// Job Offer Routes (Employee)
Route::get('/job_offers', 'Web\Employee\JobOffer\WebEmployeeJobOfferManagementController@displayListPage');
Route::post('/job_offer/accept', 'Web\JobOffer\WebJobOfferController@acceptJobOffer');
Route::post('/job_offer/reject', 'Web\JobOffer\WebJobOfferController@rejectJobOffer');

// Employer Routes
Route::get('/employer/dashboard', 'Web\Employer\WebEmployerDashboardPageController@displayDashboardPage');

//Job Post Routes (Employer)
Route::get('/employer/job_post/create', 'Web\Employer\JobPost\WebEmployerJobPostManagementController@displayCreatePage');
Route::get('/employer/job_post/update/{job_post_id}', 'Web\Employer\JobPost\WebEmployerJobPostManagementController@displayUpdatePage');
Route::get('/employer/job_posts', 'Web\Employer\JobPost\WebEmployerJobPostManagementController@displayListPage');
Route::get('/employer/job_post/{job_post_id}', 'Web\Employer\JobPost\WebEmployerJobPostManagementController@displayJobPostPage');

Route::post('/job_posts/create', 'Web\JobPost\WebJobPostController@create');
Route::post('/job_post/update', 'Web\JobPost\WebJobPostController@update');

// Job Post Application Routes
Route::get('/employer/job_post/{job_post_id}/applicants', 'Web\Employer\JobPostApplication\WebEmployerJobPostApplicationManagementController@displayJobPostApplicants');

// Job Offer Routes (Employee
Route::post('/job_offer/create', 'Web\JobOffer\WebJobOfferController@hireApplicant');

// Job Offer Routes (Employer)
Route::get('/employer/job_offers', 'Web\Employer\JobOffer\WebEmployerJobOfferManagementController@displayJobOffers');

// Company Routes
Route::get('/company/{company_id}', 'Web\Company\WebCompanyDetailController@displayDetailPage');
Route::get('/company/{company_id}/employees', 'Web\Company\WebCompanyDetailController@displayCompanyEmployeesPage');

// Company Review Routes
Route::Post('/company/review', 'Web\company\WebCompanyController@createReview');

// TODO :: Add update and delete routes and functions

// TODO :: Remove routes below
Route::get('/admin/management/jobpost', 'Web\JobPost\WebJobPostManagementController@displayListPage');
Route::get('/admin/management/jobpost/create', 'Web\JobPost\WebJobPostManagementController@displayCreatePage');
