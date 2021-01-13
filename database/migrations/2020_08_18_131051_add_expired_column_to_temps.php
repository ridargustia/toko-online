<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExpiredColumnToTemps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('temps', function (Blueprint $table){
            $table->string('gambar')->after('penjualan')->nullable();
            $table->date('expired')->after('penjualan')->nullable();
            $table->dateTime('notif_status')->after('no_telpon')->nullable();
            $table->boolean('batas_bayar')->after('no_telpon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temps', function (Blueprint $table) {
            $table->dropColumn('gambar');
            $table->dropColumn('expired');
            $table->dropColumn('notif_status');
            $table->dropColumn('batas_bayar');
        });
    }
}
