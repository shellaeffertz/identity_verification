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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'phone',
        'name',
        'role',
        'firstname',
        'lastname',
        'address',
        'country',
        'city',
        'code',
        'birthday',
        'birth_place',
        'id_front_side',
        'id_back_side',
        'selfie',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getIdFrontSideAttribute($value) {

        return json_decode($value);
    }

    public function getIdBackSideAttribute($value) {

        return json_decode($value);
    }

    public function getSelfieAttribute($value) {

        return json_decode($value);
    }
}
