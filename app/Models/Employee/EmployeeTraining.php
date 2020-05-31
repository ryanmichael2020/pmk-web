<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Model;

class EmployeeTraining extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id', 'training', 'start_month', 'end_month', 'start_year', 'end_year',
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

    public function trainingSimpleDate()
    {
        return $this->start_month . '/' . $this->start_year . ' - ' . $this->end_month . '/' . $this->end_year;
    }
}
