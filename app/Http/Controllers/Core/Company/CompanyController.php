<?php

namespace App\Http\Controllers\Core\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\Company;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    public static function create($name, $contact)
    {
        $response = array();

        try {
            DB::beginTransaction();

            $company = new Company();
            $company->name = $name;
            $company->contact = $contact;
            $company->save();

            DB::commit();

            $data = array();
            $data['company'] = $company;

            $response['data'] = $data;
            $response['message'] = 'Company created successfully.';
            $response['status_code'] = Response::HTTP_OK;
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());
            $error_code = $exception->errorInfo[1];

            Log::error($error_code);
            if ($error_code == 1062) {
                $error = array();
                $error['message'] = 'Company name already exists.';

                $response['error'] = $error;
                $response['message'] = ' Failed to create company.';
            } else {
                $error = array();
                $error['message'] = 'Query exception occurred.';

                $response['error'] = $error;
                $response['message'] = ' Failed to create company.';
                $response['status_code'] = Response::HTTP_BAD_REQUEST;
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            $error = array();
            $error['message'] = 'Unknown error occurred.';

            $response['error'] = $error;
            $response['message'] = ' Failed to create company.';
            $response['status_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }
}
