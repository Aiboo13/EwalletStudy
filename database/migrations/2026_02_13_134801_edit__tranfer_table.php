<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        // menambhkan kolom status setelah kolom amount 
        Schema::table('transferss', function (Blueprint $table) {
            $table->string('status')->after('amount')->default('succes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transferss', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
