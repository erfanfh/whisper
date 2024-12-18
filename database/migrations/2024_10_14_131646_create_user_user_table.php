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
        Schema::create('user_user', function (Blueprint $table) {

            $table->unsignedBigInteger('follower_id');
            $table->foreign('follower_id')->references('id')->on('users');

            $table->unsignedBigInteger('following_id');
            $table->foreign('following_id')->references('id')->on('users');

            $table->primary(['follower_id', 'following_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_user');
    }
};
