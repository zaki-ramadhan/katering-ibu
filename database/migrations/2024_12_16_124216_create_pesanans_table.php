<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('payment_method');
            $table->string('pickup_method');
            $table->string('delivery_address')->nullable();
            $table->decimal('shipping_cost', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->string('status')->default('Pending'); // Tambahkan kolom status di sini
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
};
