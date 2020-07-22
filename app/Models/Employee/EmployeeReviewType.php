<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Model;

class EmployeeReviewType extends Model
{
    static $PUNCTUALITY = 1;
    static $PERFORMANCE = 2;
    static $PERSONALITY = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
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

    public function employeeReviewScores()
    {
        return $this->hasMany(EmployeeReviewScore::class);
    }
}
