<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
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

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
