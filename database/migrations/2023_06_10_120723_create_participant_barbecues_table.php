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
        Schema::create('participants_barbecue', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('date_of_birth');
            $table->string('email_address');
            $table->string('phone_number');
            $table->string('student_number')->nullable()->default(null);
            $table->string('membership_id')->nullable()->default(null);
            $table->string('address');
            $table->string('postal_code');
            $table->string('residence');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->string('field_of_study');
            $table->integer('study_year')->default(1);
            $table->string('dietary_requirements')->nullable()->default(null);
            $table->string('remarks')->nullable()->default(null);
            $table->boolean('first_year')->default(false);
            $table->boolean('senior')->default(false);
            $table->boolean('introcee')->default(false);
            $table->boolean('herocee')->default(false);
            $table->boolean('candidate_board')->default(false);
            $table->boolean('board')->default(false);
            $table->boolean('photocee')->default(false);
            $table->boolean('paid')->default(false);
            $table->timestamp('paid_at')->nullable()->default(null);
            $table->string('payment_reference')->nullable()->default(null);
            $table->float('fee')->default(0);
            $table->float('final_fee')->nullable()->default(null);
            $table->boolean('mentor')->default(false);
            $table->boolean('terms_and_conditions')->default(false);
            $table->boolean('confirmed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants_barbecue');
    }
};
