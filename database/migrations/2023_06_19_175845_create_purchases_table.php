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
        Schema::create('purchases', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('product')->nullable();
            $table->uuid('wallet')->nullable();
            $table->foreign('product')->references('id')->on('products')->onDelete('set null');
            $table->foreign('wallet')->references('id')->on('wallets')->onDelete('set null');
            $table->boolean('undone')->default(false);
            $table->float('price_per_unit')->default(0);
            $table->integer('quantity')->default('1');
            $table->float('total')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
