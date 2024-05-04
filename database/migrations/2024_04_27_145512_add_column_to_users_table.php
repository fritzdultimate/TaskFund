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
        Schema::table('users', function (Blueprint $table) {
            // $table->string('phone_number')->nullable();
            // $table->string('referrer_username')->nullable();
            // $table->decimal('referral_bonus', 20)->default(0.00);

            // $table->decimal('total_deposited', 20)->default(0.00);

            // $table->string('task_referral_commission')->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
