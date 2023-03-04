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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('currency');
            $table->integer('redeem_thread');
            $table->float('coin_rate');
            $table->integer('minimum_users_live');
            $table->integer('maximum_min_users_live');
            $table->integer('message_price');
            $table->integer('reverse_swipe_price');
            $table->integer('live_watching_price');
            $table->integer('for_dating_app');
            $table->string('ad_banner_android');
            $table->string('ad_interstitial_android');
            $table->string('ad_banner_iOS');
            $table->string('ad_interstitial_iOS');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
