<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Permissions\HasPermissionsTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UserstampsTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, SoftDeletes, UserstampsTrait, HasPermissionsTrait;

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone_no',
        'password',
        'status',
        'force_logout'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'boolean',
        'force_logout' => 'boolean'
    ];

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function role()
    {
        return $this->hasOne(UserRole::class);
    }

    public function teacher()
    {
        return $this->hasOne(Employee::class);
    }
}