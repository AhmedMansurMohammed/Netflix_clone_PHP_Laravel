<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone_number',
        'address',
    ];

    public function subscriptions()
    {
        return $this->hasOne(Subscription::class, 'id_user', 'id_user');
    }

    public function favoriteMedias()
    {
        return $this->belongsToMany(Media::class, 'favorite_medias', 'id_user', 'id_media');
    }

}