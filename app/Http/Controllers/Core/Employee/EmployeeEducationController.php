<?php

namespace App\Http\Controllers\Core\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeEducation;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeEducationController extends Controller
{
    public static function create($employee_id, $school, $education_level_id, $start_year, $end_year = null)
    {
        $response = array();

        try {
            $employee = Employee::where('id', $employee_id)->first();

            if ($employee != null) {
                // if employee exists
                DB::beginTransaction();

                $employee_education = new EmployeeEducation();
                $employee_education->employee_id = $employee_id;
                $employee_education->school = $school;
                $employee_education->education_level_id = $education_level_id;
                $employee_education->start_year = $start_year;
                $employee_education->end_year = $end_year;
                $employee_education->save();

                DB::commit();

                $data = array();
                $data['employee_education'] = $employee_education;

                $response['data'] = $data;
                $response['message'] = 'Employee education successfully created.';
                $response['status_code'] = Response::HTTP_OK;
            } else {
                // if employee does not exist
                $error = array();
                $error['message'] = 'Employee not found.';

                $response['error'] = $error;
                $response['message'] = 'Failed to create employee education.';
                $response['status_code'] = Response::HTTP_BAD_REQUEST;
            }
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error_code = $exception->errorInfo[1];
            Log::error($error_code);

            $error = array();
            $error['message'] = 'Query exception occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to create employee education.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to create employee education.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }

    public static function update($employee_education_id, $school, $education_level_id, $start_year, $end_year = null)
    {
        $response = array();

        try {
            $employee_education = EmployeeEducation::where('id', $employee_education_id)->first();

            if ($employee_education != null) {
                // if employee education exists
                DB::beginTransaction();

                $employee_education->school = $school;
                $employee_education->education_level_id = $education_level_id;
                $employee_education->start_year = $start_year;
                $employee_education->end_year = $end_year;
                $employee_education->save();

                DB::commit();

                $data = array();
                $data['employee_education'] = $employee_education;

                $response['data'] = $data;
                $response['message'] = 'Employee education successfully updated.';
                $response['status_code'] = Response::HTTP_OK;
            } else {
                // if employee education does not exist
                $error = array();
                $error['message'] = 'Employee education not found.';

                $response['error'] = $error;
                $response['message'] = 'Failed to update employee education.';
                $response['status_code'] = Response::HTTP_BAD_REQUEST;
            }
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error_code = $exception->errorInfo[1];
            Log::error($error_code);

            $error = array();
            $error['message'] = 'Query exception occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to update employee education.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to update employee education.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }

    public static function delete($employee_education_id)
    {
        $response = array();

        try {
            $employee_education = EmployeeEducation::where('id', $employee_education_id)->first();

            if ($employee_education != null) {
                // if employee education exists
                DB::beginTransaction();

                $employee_education->delete();

                DB::commit();

                $response['message'] = 'Employee education successfully deleted.';
                $response['status_code'] = Response::HTTP_OK;
            } else {
                // if employee education does not exist
                $error = array();
                $error['message'] = 'Employee education not found.';

                $response['error'] = $error;
                $response['message'] = 'Failed to delete employee education.';
                $response['status_code'] = Response::HTTP_BAD_REQUEST;
            }
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error_code = $exception->errorInfo[1];
            Log::error($error_code);

            $error = array();
            $error['message'] = 'Query exception occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to delete employee education.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to delete employee education.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }
}
