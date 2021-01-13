<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $fillable = ['nama_barang', 'jumlah', 'harga_pokok', 'harga_jual', 'laba', 'kategori'];
}
