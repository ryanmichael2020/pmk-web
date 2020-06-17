<?php

namespace App\Models\JobPost;

use App\Models\Employee\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class JobPostApplication extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_post_application_status_id', 'job_post_id', 'employee_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    public function jobPostApplicationStatus()
    {
        return $this->belongsTo(JobPostApplicationStatus::class);
    }

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function acceptable()
    {
        if ($this->job_post_application_status_id == JobPostApplicationStatus::$UNDER_REVIEW) {
            return true;
        }

        return false;
    }

    public function reviewable()
    {
        if ($this->job_post_application_status_id == JobPostApplicationStatus::$PENDING) {
            return true;
        }

        return false;
    }

    public function rejectable()
    {
        if ($this->job_post_application_status_id == JobPostApplicationStatus::$CANCELLED) {
            return false;
        } else if ($this->job_post_application_status_id == JobPostApplicationStatus::$REJECTED) {
            return false;
        }

        return true;
    }

    public function revokable()
    {
        if ($this->job_post_application_status_id == JobPostApplicationStatus::$ACCEPTED) {
            return true;
        }

        return false;
    }

    public function cancellable()
    {
        if ($this->job_post_application_status_id == JobPostApplicationStatus::$CANCELLED) {
            return false;
        } else if ($this->job_post_application_status_id == JobPostApplicationStatus::$ACCEPTED) {
            return false;
        }

        return true;
    }
}
