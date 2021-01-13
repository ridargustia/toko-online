<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsernameColumnToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table){
            $table->string('foto')->after('name');
            $table->integer('jml_produk_dibeli')->after('name');
            $table->integer('jml_transaksi')->after('name');
            $table->string('no_telpon')->after('name');
            $table->string('username')->after('name');
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
            $table->dropColumn('username');
        });
    }
}
