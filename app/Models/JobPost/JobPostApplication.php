<?php

namespace App\Models\JobPost;

use App\Models\Employee\Employee;
use App\Models\JobOffer\JobOffer;
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

    public function jobOffers()
    {
        return $this->hasOne(JobOffer::class);
    }

    public function isAccepted()
    {
        if ($this->job_post_application_status_id == JobPostApplicationStatus::$SENT_JOB_OFFER) {
            return true;
        }

        return false;
    }

    public function hireable()
    {
        $job_offer = JobOffer::where('job_post_application_id', $this->id)->first();
        $has_sent_offer = ($job_offer == null) ? false : true;

        if ($this->job_post_application_status_id == JobPostApplicationStatus::$UNDER_REVIEW && !$has_sent_offer) {
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
        if ($this->job_post_application_status_id == JobPostApplicationStatus::$PENDING) {
            return true;
        }

        return false;
    }

    public function revokable()
    {
        if ($this->job_post_application_status_id == JobPostApplicationStatus::$SENT_JOB_OFFER) {
            return true;
        }

        return false;
    }

    public function cancellable()
    {
        if ($this->job_post_application_status_id == JobPostApplicationStatus::$CANCELLED) {
            return false;
        } else if ($this->job_post_application_status_id == JobPostApplicationStatus::$SENT_JOB_OFFER) {
            return false;
        }

        return true;
    }
}
