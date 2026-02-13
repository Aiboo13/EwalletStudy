<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transfer extends Model
{
    protected $fillable = [
        'sender_wallet_id',
        'receiver_wallet_id',
        'amount',
        'status',
        'description',
    ];
}
