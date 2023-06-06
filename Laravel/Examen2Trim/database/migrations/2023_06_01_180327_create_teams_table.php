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
        Schema::create('teams', function (Blueprint $table) {
            $table->id('id_team');
            $table->string('name', 255);
            $table->string('nationality', 255);
            $table->integer('year');
            $table->BigInteger('player_id')->unsigned();
            $table->timestamps();

            $table->foreign('player_id')
                  ->references('id_user')
                  ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
