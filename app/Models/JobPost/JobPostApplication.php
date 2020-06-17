<?php

namespace App\Models\JobPost;

use App\Models\Employee\Employee;
use Illuminate\Database\Eloquent\Model;

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
