<?php

namespace App\Models\JobPost;

use Illuminate\Database\Eloquent\Model;

class JobPostApplicationStatus extends Model
{
    public static $PENDING = 1;
    public static $UNDER_REVIEW = 2;
    public static $SENT_JOB_OFFER = 3;
    public static $HIRED = 4;
    public static $REJECTED = 5;
    public static $CANCELLED = 6;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
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

    public function jobPostApplications()
    {
        return $this->hasMany(JobPostApplication::class);
    }
}
