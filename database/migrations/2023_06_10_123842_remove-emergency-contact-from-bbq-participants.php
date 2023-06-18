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
        Schema::table('participants_barbecue', function (Blueprint $table) {
            $table->dropColumn('emergency_contact_name');
            $table->dropColumn('emergency_contact_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participants_barbecue', function (Blueprint $table) {
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
        });
    }
};
