<?php

namespace App\Http\Controllers\Web\Employer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Employer\EmployerController;
use App\Http\Requests\Employer\CreateEmployerRequest;
use App\Http\Requests\Employer\UpdateEmployerRequest;
use App\Models\Employer\Employer;
use App\Models\User\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class WebEmployerController extends Controller
{
    private function detailedViewRoute($id)
    {
        return "/admin/management/employer/$id";
    }

    private function editRoute($id)
    {
        return "/admin/management/employer/$id/update";
    }

    public function create(CreateEmployerRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $verify_password = $request->verify_password;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $sex = $request->sex;
        $company_id = $request->company_id;
        $image = $request->image;
        $response = EmployerController::create($email, $password, $verify_password, $first_name, $last_name, $sex, $company_id, $image);

        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);
            return redirect('/admin/management/employers');
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);

            return redirect()->back();
        }
    }

    public function update(UpdateEmployerRequest $request) {
        $employer_id = $request->employer_id;
        $email = $request->email;
        $password = $request->password;
        $verify_password = $request->verify_password;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $sex = $request->sex;
        $company_id = $request->company_id;
        $image = $request->image;

        if ($image == null) {
            Log::debug('Image is null');
        }

        $response = EmployerController::update($employer_id, $email, $first_name, $last_name, $sex, $company_id, $image);

        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);
            return redirect('/admin/management/employers');
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);

            return redirect()->back();
        }
    }

    public function getDataTable()
    {
        $employer_user_ids = Employer::all()->pluck('user_id');
        $employers = User::with('userDetail', 'employer.company')
            ->whereIn('id', $employer_user_ids)->get();

        $data = DataTables::of($employers)
            ->addColumn('action', function ($data) {
                $button = '<a href="' . $this->editRoute($data->employer->id) . '" class="mx-1" title="Edit"><i class="fas fa-edit fa-lg"></i></a>';
                $button .= '<a href="' . $this->detailedViewRoute($data->employer->id) . '" class="mx-1" title="View"><i class="fas fa-eye fa-lg"></i></a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);

        return $data;
    }
}
