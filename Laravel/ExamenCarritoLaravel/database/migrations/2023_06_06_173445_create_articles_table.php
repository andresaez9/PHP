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
        Schema::create('articles', function (Blueprint $table) {
            $table->id("idArticles");
            $table->string("name", 45);
            $table->string("description", 255);
            $table->integer("stock", 11);
            $table->bigInteger("category")->unsigned();
            $table->timestamps();

            $table->foreign('category')->references('idCat')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
