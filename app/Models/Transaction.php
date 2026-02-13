<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    // use SoftDeletes;
    protected $fillable = [
        // wajib fillable sesuai nama kolom di database
        'wallet_id',
        'type',
        'amount',
        'status',
        'description',
    ];
}
