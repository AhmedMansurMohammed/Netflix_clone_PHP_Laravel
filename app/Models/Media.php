<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'medias';
    protected $primaryKey = 'id_media';
    protected $fillable = ['title', 'description', 'release_year', 'likes', 'director', 'img_url', 'isSerie', 'country', 'episodes'];

    public function actors()
    {
        return $this->belongsToMany(People::class, 'media_actors', 'id_media', 'id_person');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'media_genres', 'id_media', 'id_genre');
    }

    public function director()
    {
        return $this->belongsTo(People::class, 'director', 'id_person');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country', 'id_country');
    }
    
    public function episodes()
    {
        return $this->hasMany(Episode::class, 'id_media');
    }
    public function episodesBySeason($seasonNumber)
    {
        return $this->episodes()->where('season_number', $seasonNumber)->get();
    }

    /**
     * Define la relación con las películas favoritas del usuario.
     */
    public function favorites()
    {
        return $this->belongsToMany(Media::class, 'favorites', 'id_media', 'id_user')->withTimestamps();
    }

    public function favorite()
    {
        return $this->belongsToMany(User::class, 'favorite', 'id_user', 'id_media')->withTimestamps();
    }

    public function favoriteMedias()
    {
        return $this->belongsToMany(User::class, 'favorite_medias', 'id_media','id_user');

    }

}
