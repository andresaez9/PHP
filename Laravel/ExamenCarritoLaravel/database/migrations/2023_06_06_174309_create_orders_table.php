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
            $table->id("idOrder");
            $table->bigInteger('customer')->unsigned();
            $table->bigInteger('article')->unsigned();
            $table->integer('units', 11);
            $table->timestamps();

            $table->foreign('customer')->references('idCustomer')->on('users');
            $table->foreign('article')->references('idArticle')->on('articles');
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
