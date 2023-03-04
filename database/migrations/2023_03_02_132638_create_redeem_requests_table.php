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
        Schema::create('redeem_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('request_id');
            $table->integer('coin_amount');
            $table->float('payable_amount')->default(0);
            $table->float('amount_paid')->nullable();
            $table->string('payment_gateway');
            $table->string('account_detail');
            $table->integer('is_completed')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redeem_requests');
    }
};
