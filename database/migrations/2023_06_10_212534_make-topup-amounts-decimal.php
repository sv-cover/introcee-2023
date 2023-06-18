<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('top_ups', function (Blueprint $table) {
            $table->decimal('amount', 8, 2)->default(0)->change();
            $table->decimal('final_amount', 8, 2)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('top_ups', function (Blueprint $table) {
            $table->integer('amount')->default(0)->change();
            $table->integer('final_amount')->default(0)->change();
        });
    }
};
