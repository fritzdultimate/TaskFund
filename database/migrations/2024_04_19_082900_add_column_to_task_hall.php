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
            // $table->string('fund_password')->nullable()->change();
            // $table->foreignId('bank_detail_id')->constrained('bank_details')->cascadeOnDelete();
            // $table->dropColumn('bank_details_id');

            $table->string('total_rebates')->default(0.00);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('withdrawals', function (Blueprint $table) {
            //
        });
    }
};
