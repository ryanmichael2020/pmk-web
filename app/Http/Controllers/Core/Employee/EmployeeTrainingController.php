<?php

namespace App\Http\Controllers\Core\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee\EmployeeTraining;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeTrainingController extends Controller
{
    public static function create($employee_id, $training, $month, $year)
    {
        $response = array();

        try {
            DB::beginTransaction();

            $employee_training = new EmployeeTraining();
            $employee_training->employee_id = $employee_id;
            $employee_training->training = $training;
            $employee_training->month = $month;
            $employee_training->year = $year;
            $employee_training->save();

            DB::commit();

            $data = array();
            $data['employee_training'] = $employee_training;

            $response['data'] = $data;
            $response['message'] = 'Employee training successfully created.';
            $response['status_code'] = Response::HTTP_OK;
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error_code = $exception->errorInfo[1];
            Log::error($error_code);

            $error = array();
            $error['message'] = 'Query exception occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to create employee training.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to create employee training.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }

    // TODO :: Add update function if needed

    public static function delete($employee_training_id)
    {
        $response = array();

        try {
            $employee_training = EmployeeTraining::where('id', $employee_training_id)->first();

            if ($employee_training != null) {
                // if employee training exists
                DB::beginTransaction();

                $employee_training->delete();

                DB::commit();

                $response['message'] = 'Employee training successfully deleted.';
                $response['status_code'] = Response::HTTP_OK;
            } else {
                // if employee training does not exist
                $error = array();
                $error['message'] = 'Employee training not found.';

                $response['error'] = $error;
                $response['message'] = 'Failed delete employee training.';
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
            $response['message'] = 'Failed to delete employee training.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to delete employee training.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }
}
