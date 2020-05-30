<?php

namespace App\Models\Module;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'module',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function userTypeModules()
    {
        return $this->hasMany(UserTypeModule::class);
    }
}
