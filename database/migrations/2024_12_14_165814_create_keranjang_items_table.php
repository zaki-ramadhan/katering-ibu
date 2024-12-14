<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeranjangItemsTable extends Migration
{
    public function up()
    {
        Schema::create('keranjang_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('keranjang_id');
            $table->unsignedBigInteger('menu_id');
            $table->integer('jumlah');
            $table->decimal('harga', 10, 2);
            $table->decimal('total_harga_item', 10, 2);
            $table->timestamps();
        
            $table->foreign('keranjang_id')->references('id')->on('keranjang')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade');
        });        
    }

    public function down()
    {
        Schema::dropIfExists('keranjang_items');
    }
}