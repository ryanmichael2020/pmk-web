<?php

namespace App\Http\Controllers\Web\Company;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Company\CompanyController;
use App\Http\Requests\Company\CreateCompanyRequest;
use App\Models\Company\Company;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class WebCompanyController extends Controller
{
    private function detailedViewRoute($id)
    {
        return "/admin/management/company/$id";
    }

    private function editRoute($id)
    {
        return "/admin/management/company/$id/update";
    }

    public function create(CreateCompanyRequest $request)
    {
        $name = $request->name;
        $contact = $request->contact;

        $response = CompanyController::create($name, $contact);
        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);

            return redirect('/admin/management/companies');
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);

            return redirect()->back();
        }
    }

    public function getDataTable() {
        $companies = Company::all();

        $data = DataTables::of($companies)
            ->addColumn('action', function ($data) {
                $button = '<a href="' . $this->editRoute($data->id) . '" class="mx-1" title="Edit"><i class="fas fa-edit fa-lg"></i></a>';
                $button .= '<a href="' . $this->detailedViewRoute($data->id) . '" class="mx-1" title="View"><i class="fas fa-eye fa-lg"></i></a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);

        return $data;
    }
}
