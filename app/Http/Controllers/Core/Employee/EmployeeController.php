<?php

namespace App\Http\Controllers\Core\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeCompanyHistory;
use App\Models\Notification\Notification;
use App\Models\Notification\NotificationType;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public static function update($employee_id, $age, $address, $mobile)
    {
        $response = array();

        try {
            $employee = Employee::where('id', $employee_id)->first();

            if ($employee != null) {
                // if employee exists
                DB::beginTransaction();

                $employee->age = $age;
                $employee->address = $address;
                $employee->mobile = $mobile;
                $employee->save();

                DB::commit();

                $data = array();
                $data['employee'] = $employee;

                $response['data'] = $employee;
                $response['message'] = 'Employee details successfully updated.';
                $response['status_code'] = Response::HTTP_OK;
            } else {
                // if employee does not exist
                $error = array();
                $error['message'] = 'Employee not found.';

                $response['error'] = $error;
                $response['message'] = 'Failed to update employee details.';
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
            $response['message'] = 'Failed to update employee details.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to update employee details.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }

    public static function dismissEmployee($employee_id)
    {
        $response = array();

        try {
            $employee = Employee::where('id', $employee_id)->first();

            if ($employee != null) {
                // if employee exists

                DB::beginTransaction();

                $name = $employee->user->userDetail->name();
                $company_name = $employee->company->name;

                $employee->company_id = null;
                $employee->job_post_id = null;
                $employee->save();

                $employee_company_history = EmployeeCompanyHistory::where('company_id', $employee->company->id)
                    ->where('employee_id', $employee_id)->first();
                $employee_company_history->dismissed_at = Carbon::now();
                $employee_company_history->save();

                $notification = new Notification();
                $notification->sender_id = auth()->user()->id;
                $notification->recipient_id = $employee->user_id;
                $notification->notification_type_id = NotificationType::$EMPLOYEE_DISMISSED;
                $notification->title = 'Employment Dismissed';
                $notification->message = 'You have been dismissed from your employment by your company.';
                $notification->save();

                DB::commit();

                $message = "$name successfully dismissed from $company_name";
                $response['message'] = $message;
                $response['status_code'] = Response::HTTP_OK;
            } else {
                // if employee does not exist

                $error = array();
                $error['message'] = 'Employee not found.';

                $response['error'] = $error;
                $response['message'] = 'Failed to dismiss employee.';
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
            $response['message'] = 'Failed to dismiss employee.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to dismiss employee.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }
}
