<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detailbahanbakumasuk extends Model
{
    protected $table = 'detail_bahan_baku_masuk';
    protected $fillable = [
        'id_detail_bahan_baku_masuk', 'id_transaksi_masuk', 'id_bahan_baku', 'jumlah_masuk'
    ];
    protected $primaryKey = 'id_detail_bahan_baku_masuk';
}
