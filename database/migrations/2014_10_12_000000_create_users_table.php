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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_id')
                ->nullable()
                ->constrained('levels')
                ->cascadeOnDelete();
            $table->string('username');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->decimal('balance', 20)->default(0.00);
            $table->decimal('total_earning', 20)->default(0.00);
            $table->decimal('total_withdrawal', 20)->default(0.00);
            $table->string('password');
            $table->string('fund_password')->nullable();
            $table->rememberToken();
            $table->enum('gender', ['male', 'female', 'other'])->default('male');
            $table->timestamp('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('phone_number')->nullable();
            $table->boolean('is_suspended')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('toured')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('users');
    }
};
