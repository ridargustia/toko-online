<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class recapitulation extends Model
{
    protected $fillable = ['total_hargapokok', 'total_hargajual', 'laba'];
}
