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
        Schema::table('participants_camp', function (Blueprint $table) {
            $table->uuid('bus')->nullable()->default(null);
            $table->foreign('bus')->references('id')->on('buses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participants_camp', function (Blueprint $table) {
            $table->dropForeign('participants_camp_bus_foreign');
            $table->dropColumn('bus');
        });
    }
};
