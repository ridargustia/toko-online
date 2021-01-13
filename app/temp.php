<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class temp extends Model
{
    protected $fillable = ['id_public', 'nama_barang', 'harga_pokok', 'harga_jual', 'kategori', 'stok', 'penjualan', 'expired', 'gambar', 'username', 'nama', 'alamat', 'no_telpon', 'batas_bayar', 'notif_status', 'jumlah', 'laba'];
}
