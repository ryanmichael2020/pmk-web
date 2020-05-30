<?php

namespace App\Models\Employee;

use App\Models\Company\Company;
use Illuminate\Database\Eloquent\Model;

class EmployeeReview extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'employee_id', 'score',
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

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function employeeReviewScores()
    {
        return $this->hasMany(EmployeeReviewScore::class);
    }
}
