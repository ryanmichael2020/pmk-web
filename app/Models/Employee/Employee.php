<?php

namespace App\Models\Employee;

use App\Models\Company\Company;
use App\Models\Company\CompanyReview;
use App\Models\JobOffer\JobOffer;
use App\Models\JobPost\JobPost;
use App\Models\JobPost\JobPostApplication;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'age', 'address', 'mobile', 'company_id', 'job_post_id',
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

    public function getAgeAttribute($value) {
        return ($this->attributes['age'] == null) ? 'N/A' : $this->age;
    }

    public function getMobileAttribute($value) {
        return ($this->attributes['mobile'] == null) ? 'N/A' : $this->mobile;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employeeSkills()
    {
        return $this->hasMany(EmployeeSkill::class);
    }

    public function employeeEducations()
    {
        return $this->hasMany(EmployeeEducation::class);
    }

    public function employeeTrainings()
    {
        return $this->hasMany(EmployeeTraining::class)->orderBy('year', 'desc');
    }

    public function employeeReviews()
    {
        return $this->hasMany(EmployeeReview::class);
    }

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }

    public function jobPostApplications()
    {
        return $this->hasMany(JobPostApplication::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function companyReviews()
    {
        return $this->hasMany(CompanyReview::class);
    }

    public function employeeCompanyHistory()
    {
        return $this->hasMany(EmployeeCompanyHistory::class);
    }

    public function jobOffers()
    {
        return $this->hasMany(JobOffer::class);
    }
}
