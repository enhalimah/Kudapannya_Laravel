<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_product';

    protected $fillable = [
        'nama_product',
        'harga_product',
        'stok',
        'desc_product',
        'gambar_product',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'nama_product', 'nama_product');
    }
}