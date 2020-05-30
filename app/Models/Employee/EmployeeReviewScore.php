<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Model;

class EmployeeReviewScore extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_review_id', 'employee_review_type_id', 'score',
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

    public function employeeReview()
    {
        return $this->belongsTo(EmployeeReview::class);
    }

    public function employeeReviewType()
    {
        return $this->belongsTo(EmployeeReviewType::class);
    }
}
