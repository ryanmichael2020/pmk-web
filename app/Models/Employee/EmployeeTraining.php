<?php

namespace App\Models\Employee;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EmployeeTraining extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id', 'training', 'month', 'year',
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
        return Carbon::create(0, $this->month)->monthName . ' ' . $this->year;
    }
}
