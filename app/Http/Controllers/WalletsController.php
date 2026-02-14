<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Wallets;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;
use Exception;
class WalletsController extends Controller
{
    // menampilkan saldo wallet user
        function index(){
            $user = JWTAuth::parsetoken()->authenticate();
        $wallet = Wallets::where('user_id', $user->id)->first();
        if($wallet){
            return response()->json([
                'status' => 'succes',
                'massage' => 'Wallet found',
                'with balance' => $wallet->balance
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'massage' => 'Wallet not found'
            ], 404);
        }

    }

    function deposit(Request $request){
        $user = JWTAuth::parsetoken()->authenticate();
        $wallet = Wallets::where('user_id', $user->id)->first();
        $validator = Validator::make($request->all(),[
            'amount' => 'required|numeric|min:1000',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }
        // tambah saldo
        $wallet->balance += $request->amount;
        $wallet->save();
        Transaction::create([
            'wallet_id' => $wallet->id,
            'type' => 'deposit',
            'amount' => $request->amount,
            'status' => 'success',
            'description' => 'Deposit to wallet'
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Deposit successful',
            'new_balance' => $wallet->balance
        ], 200);
    }

    // menarik saldo dari wallet user
    function withdraw(Request $request){
        $user = JWTAuth::parsetoken()->authenticate();
        $wallet = Wallets::where('user_id', $user->id)->first();
        $validator = Validator::make($request->all(),[
            'amount' => 'required|numeric|min:1000',
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
        // melakukan penarikan saldo
        $wallet->balance -= $request->amount;
        $wallet->save();
        Transaction::create([
            'wallet_id' => $wallet->id,
            'type' => 'withdraw',
            'amount' => $request->amount,
            'status' => 'success',
            'description' => 'Withdraw from wallet'
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'withdraw successful',
            'new_balance' => $wallet->balance
        ], 200);
    }
}
