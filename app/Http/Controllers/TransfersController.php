<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\transfer;
use Illuminate\Support\Facades\Validator;
use tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Wallets;
use App\Models\Transaction;

class transfersController extends Controller
{
    function transfers(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        $wallet = Wallets::where('user_id', $user->id)->first();
        $validator = Validator::make($request->all(),[
            'receiver_wallet_id' => 'required|integer|exists:wallets,id',
            'amount' => 'required|numeric|min:1000',
            'status' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        if($wallet->balance < $request->amount){
            return response()->json([
                'status' => 'error',
                'message' => 'Insufficient balance'
            ], 400);
        }

        // kurangi saldo pengirim
        $wallet->balance -= $request->amount;
        $wallet->save();
        $request = $request->merge(['sender_wallet_id' => $wallet->id, 'status' => 'success']);
        transfer::create($request->all());
        // tambah saldo penerima
        $receiverWallet = Wallets::where('id', $request->receiver_wallet_id)->first();
        $receiverWallet->balance += $request->amount;
        $receiverWallet->save();
        return response()->json([
            'status' => 'success',
            'message' => 'transfers successful',
            'saldo yang tersedia' => $wallet->balance,
            'info tranfer' =>  $request->all()
        ], 200);
    }
}
