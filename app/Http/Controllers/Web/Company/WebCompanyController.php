<?php

namespace App\Http\Controllers\Web\Company;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Company\CompanyController;
use App\Http\Controllers\Core\Company\CompanyReviewController;
use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Requests\Company\CreateCompanyReviewRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
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
        $image = ($request->has('image')) ? $request->image : null;
        $address = ($request->has('address')) ? $request->address : null;
        $description = ($request->has('description')) ? $request->description : null;

        $response = CompanyController::create($name, $contact, $image, $address, $description);
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

    public function createReview(CreateCompanyReviewRequest $request)
    {
        $employee_id = $request->employee_id;
        $company_id = $request->company_id;
        $score = $request->score;
        $comment = $request->comment;

        $response = CompanyReviewController::createReview($employee_id, $company_id, $score, $comment);

        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);
        }

        return redirect()->back();
    }

    public function update(UpdateCompanyRequest $request)
    {
        $company_id = $request->company_id;
        $name = $request->name;
        $contact = $request->contact;
        $image = ($request->has('image')) ? $request->image : null;
        $address = ($request->has('address')) ? $request->address : null;
        $description = ($request->has('description')) ? $request->description : null;

        $response = CompanyController::update($company_id, $name, $contact, $image, $address, $description);
        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);

        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);
        }

        return redirect()->back();
    }

    public function getDataTable()
    {
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
