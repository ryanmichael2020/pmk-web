<?php

namespace App\Models\User;

use App\Models\Module\UserTypeModule;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    public static $ADMIN = 1;
    public static $EMPLOYER = 2;
    public static $EMPLOYEE = 3;

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

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function userTypeModules()
    {
        return $this->hasMany(UserTypeModule::class);
    }
}
