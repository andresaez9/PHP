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
        Schema::create('team_user', function (Blueprint $table) {
            $table->id('id_teamUser');
            $table->bigInteger('id_team')->unsigned();
            $table->BigInteger('id_user')->unsigned();
            $table->boolean('captain');
            $table->timestamps();

            $table->foreign('id_team')
                ->references('id_team')
                ->on('teams');

            $table->foreign('id_user')
                ->references('id_user')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_user');
    }
};
