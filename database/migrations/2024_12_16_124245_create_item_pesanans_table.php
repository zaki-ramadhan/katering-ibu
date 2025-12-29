<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('item_pesanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pesanan_id');
            $table->unsignedBigInteger('menu_id');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->foreign('pesanan_id')->references('id')->on('pesanan')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('item_pesanan');
    }
};
