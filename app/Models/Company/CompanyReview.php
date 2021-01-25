<?php

namespace App\Models\Company;

use App\Models\Employee\Employee;
use App\Models\JobPost\JobPost;
use Illuminate\Database\Eloquent\Model;

class CompanyReview extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id', 'company_id', 'job_post_id', 'score', 'comment',
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
        return $this->belongsTo(Employee::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function job_post()
    {
        return $this->belongsTo(JobPost::class);
    }
}
