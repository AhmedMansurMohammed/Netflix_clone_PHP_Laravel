<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_subscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'type_subscriptions';
    protected $primaryKey = 'id_type';
    protected $fillable = [
        'type',
        'duration',
        'price',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'id_type', 'id_type');
    }

}
