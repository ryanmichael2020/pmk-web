<?php

namespace App\Models\JobPost;

use App\Models\Employer\Employer;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employer_id', 'job_post_status_id', 'position', 'description', 'max_applicants', 'approved_applicants',
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

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function jobPostStatus()
    {
        return $this->belongsTo(JobPostStatus::class);
    }
}
