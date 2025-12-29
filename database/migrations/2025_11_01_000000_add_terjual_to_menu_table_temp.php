<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->integer('terjual')->default(0)->after('harga');
        });
    }

    public function down()
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->dropColumn('terjual');
        });
    }
};
