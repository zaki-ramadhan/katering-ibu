<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPesananTable extends Migration
{
    public function up()
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->string('payment_proof')->nullable()->after('total_amount'); // bukti pembayaran
            $table->string('status')->default('Pending')->after('payment_proof');
            $table->date('delivery_date')->nullable()->after('payment_proof'); // tanggal pengiriman
        });
    }

    public function down()
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropColumn('payment_proof');
            $table->dropColumn('status');
            $table->dropColumn('delivery_date');
        });
    }
}
