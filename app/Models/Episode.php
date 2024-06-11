<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'episodes';
    protected $primaryKey = 'id_episode';
    protected $fillable = [
        'url',
        'title',
        'duration',
        'description',
        'id_media',
        'season',
    ];
    public function media()
    {
        return $this->belongsTo(Media::class, 'id_media');
    }

}
