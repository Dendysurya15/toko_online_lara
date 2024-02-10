<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'waktu_transaksi',
        'keterangan',
        'jumlah',
        'user_id',
        'produk_id',

    ];
    public $timestamps = false;
}
