<?php

namespace App\Models\Employee;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'age', 'address', 'mobile',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employeeSkills()
    {
        return $this->hasMany(EmployeeSkill::class);
    }

    public function employeeEducation()
    {
        return $this->hasMany(EmployeeEducation::class);
    }

    public function employeeTrainings()
    {
        return $this->hasMany(EmployeeTraining::class);
    }
}
