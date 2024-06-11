<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'countries';
    protected $primaryKey = 'id_country';

    protected $fillable = [
        'name',
    ];

    public function medias()
    {
        return $this->hasMany(Media::class, 'country', 'id_country');
    }
}
