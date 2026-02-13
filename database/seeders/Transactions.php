<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Transactions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transactions')->insert([
            [
                'wallet_id' => 1,
                'type' => 'deposit',
                'amount' => 500000,
                'status' => 'completed',
                'description' => 'Initial deposit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'wallet_id' => 1,
                'type' => 'withdrawal',
                'amount' => 200000,
                'status' => 'completed',
                'description' => 'ATM withdrawal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
