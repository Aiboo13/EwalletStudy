<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Wallets;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    // menampilkan riwayat transaksi user
    function index(){
            $user = JWTAuth::parseToken()->authenticate();
            $walletId = Wallets::where('user_id', $user->id)->first();
        $transaction = Transaction::where('wallet_id', $walletId->id)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Transaction found',
            'data' => $transaction
        ],200);  
    }

    function show($id){
        $user = JWTAuth::parseToken()->authenticate();
        $walletId = Wallets::where('user_id', $user->id)->first();
        $transaction = Transaction::where('wallet_id', $walletId->id)->where('id', $id)->first();
        if(!$transaction){
            return response()->json([
                'status' => 'error',
                'message' => 'Transaction not found'
            ],404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Transaction found',
            'data' => $transaction
        ],200);
    }

}
