<?php

namespace App\Models\Employer;

use App\Models\Company\Company;
use App\Models\JobOffer\JobOffer;
use App\Models\JobPost\JobPost;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'user_id',
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

    protected $appends = [
        'status',
    ];

    public function getStatusAttribute() {
        return ($this->deleted_at == null) ? 'ACTIVE' : 'INACTIVE';
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobPosts()
    {
        return $this->hasMany(JobPost::class);
    }

    public function jobOffers() {
        return $this->hasMany(JobOffer::class);
    }
}
