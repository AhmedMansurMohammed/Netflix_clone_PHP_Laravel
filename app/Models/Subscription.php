<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'subscriptions';
    protected $primaryKey = 'id_subscription';
    protected $fillable = [
        'id_user',
        'id_type',
        'account_number',
        'entity',
        'start_date',
        'expire_date',
    ];
    public function type()
    {
        return $this->belongsTo(Type_subscription::class, 'id_type', 'id_type');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    
}

// /**
    //  * The attributes that should be cast to native types.
    //  *
    //  * @var array<string, string>
    //  */
    // protected $casts = [
    //     'start_date' => 'date',
    //     'expire_date' => 'date',
    // ];