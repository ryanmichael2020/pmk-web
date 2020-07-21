<?php

namespace App\Models\User;

use App\Mail\VerifyEmail;
use App\Models\Employee\Employee;
use App\Models\Employer\Employer;
use App\Models\Login\DailyLoginHistory;
use App\Models\Notification\Notification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type_id', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function sendVerificationEmail()
    {
        Mail::to($this->email)->send(new VerifyEmail($this->id));
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public function userDetail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function employer()
    {
        return $this->hasOne(Employer::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function dailyLoginHistories()
    {
        return $this->hasMany(DailyLoginHistory::class);
    }
}
