<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    protected $fillable = ['username', 'nama', 'alamat', 'no_telpon', 'batas_bayar'];
}
