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
            $table->renameColumn('details', 'payment_reference');
            $table->decimal('final_amount', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('top_ups', function (Blueprint $table) {
            $table->renameColumn('payment_reference', 'details');
            $table->dropColumn('final_amount');
        });
    }
};
