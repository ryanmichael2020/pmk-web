<?php

namespace App\Models\JobPost;

use App\Models\Company\Company;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeReview;
use App\Models\Employer\Employer;
use App\Models\JobOffer\JobOffer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class JobPost extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employer_id', 'company_id', 'job_post_status_id', 'position', 'description', 'max_applicants', 'approved_applicants',
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

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function jobPostStatus()
    {
        return $this->belongsTo(JobPostStatus::class);
    }

    public function jobPostApplications()
    {
        return $this->hasMany(JobPostApplication::class);
    }

    public function jobOffers()
    {
        return $this->hasMany(JobOffer::class);
    }

    public function hasApplication($employee_id)
    {
        $job_post_applications = JobPostApplication::where('job_post_id', $this->id)
            ->whereIn('job_post_application_status_id', [
                JobPostApplicationStatus::$PENDING,
                JobPostApplicationStatus::$UNDER_REVIEW,
                JobPostApplicationStatus::$SENT_JOB_OFFER,
            ])->get();

        $employee = Employee::where('id', $employee_id)->first();

        if ($employee->job_post_id == $this->id) {
            return true;
        }

        foreach ($job_post_applications as $job_post_application) {
            if ($job_post_application->employee_id == $employee_id) {
                return true;
            }
        }

        return false;
    }

    public function allowsApplication()
    {
        $job_post_applications_count = JobPostApplication::where('job_post_id', $this->id)
            ->whereNotIn('job_post_application_status_id', [JobPostApplicationStatus::$CANCELLED, JobPostApplicationStatus::$REJECTED, JobPostApplicationStatus::$RETRACTED_JOB_OFFER])
            ->count();

        return ($this->max_applicants > $job_post_applications_count) ? true : false;
    }

    public function employeeReviews()
    {
        return $this->hasMany(EmployeeReview::class);
    }

    public function companyReviews()
    {
        return $this->hasMany(JobPost::class);
    }
}
