<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fighter extends Model
{
    protected $fillable = [
        'external_id',
        'name',
        'nickname',
        'division',
        'category',
        'record',
        'wins',
        'losses',
        'draws',
        'status',
        'img_url',
        'api_synced_at',
    ];

    protected $casts = [
        'api_synced_at' => 'datetime',
    ];
}
