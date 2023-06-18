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
            $table->dropColumn('address');
            $table->dropColumn('postal_code');
            $table->dropColumn('residence');
        });
        Schema::table('participants_barbecue', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('postal_code');
            $table->dropColumn('residence');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participants_camp', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('residence')->nullable();
        });
        Schema::table('participants_barbecue', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('residence')->nullable();
        });
    }
};
