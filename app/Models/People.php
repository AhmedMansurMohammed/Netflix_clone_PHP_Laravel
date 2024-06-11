<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'peoples';
    protected $primaryKey = 'id_person';
    protected $fillable = [
        'name',
        'profession',
    ];

    public function mediasDirected()
    {
        return $this->hasMany(Media::class, 'director', 'id_person');
    }

    public function actorMedias()
    {
        return $this->belongsToMany(Media::class, 'media_actors', 'id_person', 'id_media');
    }
}
