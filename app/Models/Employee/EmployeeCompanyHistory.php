<?php

namespace App\Models\Employee;

use App\Models\Company\Company;
use App\Models\JobPost\JobPost;
use Illuminate\Database\Eloquent\Model;

class EmployeeCompanyHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id', 'company_id', 'job_post_id', 'dismissed_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }
}
