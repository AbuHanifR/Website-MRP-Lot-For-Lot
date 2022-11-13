<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detailpesanan extends Model
{
    protected $table = 'detail_pesanan';
    protected $fillable = [
        'id_detail_pesanan', 'id_pesanan', 'id_produk', 'jumlah_pesanan'
    ];
    protected $primaryKey = 'id_detail_pesanan';
}
