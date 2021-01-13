<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    protected $fillable = ['nama_barang', 'stok', 'penjualan', 'harga_pokok', 'harga_jual', 'kategori', 'expired', 'gambar'];
}
