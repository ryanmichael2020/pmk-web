<?php

namespace App\Models\Education;

use App\Models\Employee\EmployeeEducation;
use Illuminate\Database\Eloquent\Model;

class EducationLevel extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'level',
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

    public function employeeEducations()
    {
        return $this->hasMany(EmployeeEducation::class);
    }
}
