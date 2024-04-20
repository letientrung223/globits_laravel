<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'is_active',
        'email',
        'password',
    ];
    
    public function person()
    {
        return $this->hasOne(Person::class);
    }
    public function role()
    {
        return $this->belongsToMany(Role::class);
    }

}
