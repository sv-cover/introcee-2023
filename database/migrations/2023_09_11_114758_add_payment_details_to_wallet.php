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
        Schema::table('wallets', function (Blueprint $table) {
            $table->string('iban')->nullable();
            $table->string('bic')->nullable();
            $table->string('account_holder')->nullable();
            $table->boolean('email_sent')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->dropColumn('iban');
            $table->dropColumn('bic');
            $table->dropColumn('account_holder');
            $table->dropColumn('email_sent');
        });
    }
};
