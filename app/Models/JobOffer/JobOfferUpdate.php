<?php

namespace App\Models\JobOffer;

use Illuminate\Database\Eloquent\Model;

class JobOfferUpdate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_offer_id', 'description',
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

    public function jobOffer()
    {
        return $this->belongsTo(JobOffer::class);
    }
}
