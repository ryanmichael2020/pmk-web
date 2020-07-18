<?php

namespace App\Models\Login;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class DailyLoginHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'user_type_id',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
