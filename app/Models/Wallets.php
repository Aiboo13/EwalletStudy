<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallets extends Model
{
    // use SoftDeletes;
    protected $fillable = [
        // wajid fillable sesuai nama kolom di database
        'user_id',
        'balance',
    ]; 

}
