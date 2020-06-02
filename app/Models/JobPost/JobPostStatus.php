<?php

namespace App\Models\JobPost;

use Illuminate\Database\Eloquent\Model;

class JobPostStatus extends Model
{
    public static $OPEN = 1;
    public static $FILLED = 2;
    public static $CANCELLED = 3;

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

    public function jobPosts()
    {
        return $this->hasMany(JobPost::class);
    }
}
