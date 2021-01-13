<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_barang')->nullable();
            $table->string('harga_pokok')->nullable();
            $table->string('harga_jual')->nullable();
            $table->string('kategori')->nullable();
            $table->string('stok')->nullable();
            $table->string('penjualan')->nullable();
            $table->string('username')->nullable();
            $table->string('nama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_telpon')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('laba')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temps');
    }
}
