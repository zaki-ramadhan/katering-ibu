<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pesanan', function (Blueprint $table) {
            if (!Schema::hasColumn('pesanan', 'payment_proof')) {
                $table->string('payment_proof')->nullable()->after('total_amount');
            }
            // Status already exists in create_pesanans_table, but checking just in case
            if (!Schema::hasColumn('pesanan', 'status')) {
                $table->string('status')->default('Pending')->after('payment_proof');
            }
            if (!Schema::hasColumn('pesanan', 'delivery_date')) {
                $table->date('delivery_date')->nullable()->after('payment_proof');
            }
        });
    }

    public function down()
    {
        Schema::table('pesanan', function (Blueprint $table) {
            if (Schema::hasColumn('pesanan', 'payment_proof')) {
                $table->dropColumn('payment_proof');
            }
            // status was created in the main table migration, so we probably shouldn't drop it here technically, 
            // but if we follow strict down logic:
            // $table->dropColumn('status'); 
            if (Schema::hasColumn('pesanan', 'delivery_date')) {
                $table->dropColumn('delivery_date');
            }
        });
    }
};
