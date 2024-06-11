<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'genres';
    protected $primaryKey = 'id_genre';
    protected $fillable = [
        'name',
    ];

    public function medias()
    {
        return $this->belongsToMany(Media::class, 'media_genres', 'id_genre', 'id_media');
    }
}
