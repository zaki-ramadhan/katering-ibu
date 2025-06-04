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
        Schema::table('ulasan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pesanan')->nullable()->after('id_customer');
            $table->foreign('id_pesanan')->references('id')->on('pesanan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ulasan', function (Blueprint $table) {
            $table->dropForeign(['id_pesanan']);
            $table->dropColumn('id_pesanan');
        });
    }
};
