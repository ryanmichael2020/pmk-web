<?php

namespace App\Http\Controllers\Web\JobPost;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\Employer\EmployerController;
use App\Http\Requests\Employer\CreateEmployerRequest;
use App\Models\User\User;
use Illuminate\Http\Request;

class WebJobPostController extends Controller
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
        $position = $request->position;
        $description = $request->description;
        $max_applicants = $request->max_applicants;

        $response = EmployerController::create($position, $description, $max_applicants);
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