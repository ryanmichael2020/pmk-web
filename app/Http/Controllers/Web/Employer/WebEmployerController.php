<?php

namespace App\Http\Controllers\Web\Employer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Employer\EmployerController;
use App\Http\Requests\Employer\CreateEmployerRequest;
use App\Models\Employer\Employer;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $company_id=  1;

        $response = EmployerController::create($email, $password, $verify_password, $first_name, $last_name, $sex, $company_id);
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

    public function getDataTable() {
        $employers = User::all();

        $data = DataTables::of($employers)
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
