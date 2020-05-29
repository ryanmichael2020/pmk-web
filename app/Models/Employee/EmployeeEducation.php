<?php

namespace App\Models\Employee;

use App\Models\Education\EducationLevel;
use Illuminate\Database\Eloquent\Model;

class EmployeeEducation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id', 'education_level_id', 'school', 'start_year', 'end_year',
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

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function educationLevel() {
        return $this->belongsTo(EducationLevel::class);
    }
}
