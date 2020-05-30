<?php

namespace App\Models\Module;

use App\Models\User\UserType;
use Illuminate\Database\Eloquent\Model;

class UserTypeModule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type_id', 'module_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
