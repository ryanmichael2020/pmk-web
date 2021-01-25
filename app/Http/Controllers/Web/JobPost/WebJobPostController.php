<?php

namespace App\Http\Controllers\Web\JobPost;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\JobPost\JobPostController;
use App\Http\Requests\JobPost\CreateJobPostRequest;
use App\Http\Requests\JobPost\UpdateJobPostRequest;
use App\Models\JobPost\JobPost;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class WebJobPostController extends Controller
{
    private function detailedViewRoute($id)
    {
        return "/employer/job_post/$id";
    }

    private function editRoute($id)
    {
        return "/employer/job_post/$id/update";
    }

    public function create(CreateJobPostRequest $request)
    {
        $position = $request->position;
        $description = $request->description;
        $max_applicants = $request->max_applicants;
        $employer_id = auth()->user()->employer->id;
        $company_id = auth()->user()->employer->company_id;

        $response = JobPostController::create($employer_id, $company_id, $position, $description, $max_applicants);

        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);

            return redirect('/employer/job_posts');
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);

            return redirect()->back();
        }
    }

    public function update(UpdateJobPostRequest $request)
    {
        $job_post_id = $request->job_post_id;
        $position = $request->position;
        $description = $request->description;
        $max_applicants = $request->max_applicants;
        $employer_id = auth()->user()->employer->id;

        $response = JobPostController::update($job_post_id, $employer_id, $position, $description, $max_applicants);

        if ($response['status_code'] == Response::HTTP_OK) {
            session()->flash('response_type', 'success');
            session()->flash('message', $response['message']);

            return redirect('/employer/job_posts');
        } else {
            session()->flash('response_type', 'error');
            session()->flash('message', $response['message'] . ' ' . $response['error']['message']);

            return redirect()->back();
        }
    }

    // TODO :: add delete function

    public function getDataTable()
    {
        $jobpost = JobPost::all();

        $data = DataTables::of($jobpost)
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
