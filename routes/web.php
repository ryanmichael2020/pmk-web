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

Route::post('/login', 'Web\Auth\WebAuthController@login');
Route::post('/signup', 'Web\Auth\WebAuthController@signup');
Route::post('/logout', 'Web\Auth\WebAuthController@logout');

// ADMIN Routes
Route::get('/admin/dashboard', 'Web\Admin\WebAdminDashboardPageController@displayDashboardPage');

// ADMIN -- Company Routes
Route::get('/admin/management/companies', 'Web\Company\WebCompanyManagementController@displayListPage');
Route::get('/admin/management/companies/create', 'Web\Company\WebCompanyManagementController@displayCreatePage');

Route::get('/companies/datatable', 'Web\Company\WebCompanyController@getDataTable');
Route::post('/companies/create', 'Web\Company\WebCompanyController@create');

// ADMIN -- Employer Routes
Route::get('/employers/datatable', 'Web\Employer\WebEmployerController@getDataTable');
Route::post('/employers/create', 'Web\Employer\WebEmployerController@create');

Route::get('/admin/management/employers', 'Web\Employer\WebEmployerManagementController@displayListPage');
Route::get('/admin/management/employers/create', 'Web\Employer\WebEmployerManagementController@displayCreatePage');

// Employee Routes
Route::get('/dashboard', 'Web\Employee\WebEmployeeDashboardPageController@displayDashboardPage');

// Employee Profile Routes
Route::get('/profile', 'Web\Employee\WebEmployeeProfileManagementPageController@displayProfileDashboardPage');
Route::get('/profile/account/update', 'Web\Employee\WebEmployeeProfileManagementPageController@displayProfileAccountUpdatePage');
Route::get('/profile/details/update', 'Web\Employee\WebEmployeeProfileManagementPageController@displayProfileDetailsUpdatePage');

Route::post('/profile/account/update', 'Web\Employee\WebEmployeeProfileManagementController@updateEmployeeAccount');
Route::post('/profile/details/update', 'Web\Employee\WebEmployeeProfileManagementController@updateEmployeeDetails');

//Job Post Routes
Route::post('/jobpost/create', 'Web\Company\WebJobPostController@create');

Route::get('/admin/management/jobpost', 'Web\Employer\WebJobPostManagementController@displayListPage');
Route::get('/admin/management/jobpost/create', 'Web\Employer\WebJobPostManagementController@displayCreatePage');
