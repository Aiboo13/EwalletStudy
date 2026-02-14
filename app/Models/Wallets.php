<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\TransactionController;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallets extends Model
{
    // use SoftDeletes;
    protected $fillable = [
        // wajid fillable sesuai nama kolom di database
        'user_id',
        'balance',
    ]; 

    // anomali relasi one to one dengan user
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function transactions(){
        return $this->belongsTo(TransactionController::class);
    }

}
