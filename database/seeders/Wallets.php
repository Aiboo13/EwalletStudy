<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Wallets extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('wallets')->insert([
            [
                'user_id' => 1,
                'balance' => 1000000, // Saldo awal untuk user 1
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
