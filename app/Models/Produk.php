<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang', 'jenis_barang', 'harga', 'stok'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'jenis_barang', 'id');
    }
}
