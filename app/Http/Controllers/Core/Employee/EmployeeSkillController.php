<?php

namespace App\Http\Controllers\Core\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee\EmployeeSkill;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeSkillController extends Controller
{
    public static function update($employee_id, $skills)
    {
        $response = array();

        try {
            $employee_skills = EmployeeSkill::where('employee_id', $employee_id)->get();

            DB::beginTransaction();

            // delete skills that are not in the skills_list
            foreach ($employee_skills as $employee_skill) {
                $retain = false;

                foreach ($skills as $i => $skill) {
                    if ($employee_skill->skill == $skill) {
                        $retain = true;
                        unset($skills[$i]);
                        break;
                    }
                }

                if (!$retain) {
                    $employee_skill->delete();
                }
            }

            // create skills from skills_list that are not in employee_skills
            foreach ($skills as $skill) {
                $employee_skill = new EmployeeSkill();
                $employee_skill->employee_id = $employee_id;
                $employee_skill->skill = $skill;
                $employee_skill->save();
            }

            $employee_skills = EmployeeSkill::where('employee_id', $employee_id)->get();

            DB::commit();

            $data = array();
            $data['employee_skills'] = $employee_skills;

            $response['data'] = $employee_skills;
            $response['message'] = 'Employee skills successfully updated.';
            $response['status_code'] = Response::HTTP_OK;
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error_code = $exception->errorInfo[1];
            Log::error($error_code);

            $error = array();
            $error['message'] = 'Query exception occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to update employee skills.';
            $response['status_code'] = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = 'Failed to update employee skills.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }
}
