<?php

namespace App\Models\JobOffer;

use Illuminate\Database\Eloquent\Model;

class JobOfferStatus extends Model
{
    static $PENDING = 1;
    static $ACCEPTED = 2;
    static $REJECTED = 3;
    static $EXPIRED = 4;

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

    public function jobOffers()
    {
        return $this->hasMany(JobOffer::class);
    }
}
