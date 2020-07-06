<?php

namespace App\Models\Company;

use App\Models\Employee\EmployeeReview;
use App\Models\Employer\Employer;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'contact', 'image',
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

    public function employers()
    {
        return $this->hasMany(Employer::class);
    }

    public function employeeReviews()
    {
        return $this->hasMany(EmployeeReview::class);
    }
}
