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
            $table->integer("is_verified")->default(0);
            $table->integer("user_type")->default(0);
            $table->string("identity")->unique();
            $table->string("name");
            $table->string("password");
            $table->string("lives_at")->nullable();
            $table->integer("age")->nullable();
            $table->integer("gender");
            $table->integer("live_stream")->default(1);
            $table->integer("block_user")->default(0);
            $table->string("about")->nullable();
            $table->string("bio")->nullable();
            $table->string("youtube")->nullable();
            $table->string("facebook")->nullable();
            $table->string("instagram")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
