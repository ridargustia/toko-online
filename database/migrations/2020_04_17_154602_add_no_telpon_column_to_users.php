<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNoTelponColumnToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table){
            $table->string('foto')->after('username')->nullable();
            $table->integer('jml_produk_dibeli')->after('username')->nullable();
            $table->integer('jml_transaksi')->after('username')->nullable();
            $table->string('no_telpon')->after('username')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('foto');
            $table->dropColumn('jml_produk_dibeli');
            $table->dropColumn('jml_transaksi');
            $table->dropColumn('no_telpon');
        });
    }
}
