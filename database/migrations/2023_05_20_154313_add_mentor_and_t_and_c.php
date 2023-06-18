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
            $table->boolean('mentor')->default(false);
            $table->boolean('terms_and_conditions')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participants_camp', function (Blueprint $table) {
            $table->dropColumn('mentor');
            $table->dropColumn('terms_and_conditions');
        });
    }
};
