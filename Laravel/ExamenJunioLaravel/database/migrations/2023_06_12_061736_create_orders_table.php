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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('idOrder');
            $table->bigInteger('user')->unsigned();
            $table->bigInteger('product')->unsigned();
            $table->integer('units');
            $table->timestamps();

            $table->foreign('user')->references('idUser')->on('users');
            $table->foreign('product')->references('idProd')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
