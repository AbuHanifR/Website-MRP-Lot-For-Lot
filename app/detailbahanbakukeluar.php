<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detailbahanbakukeluar extends Model
{
    protected $table = 'detail_bahan_baku_keluar';
    protected $fillable = [
        'id_detail_bahan_baku_keluar', 'id_transaksi_keluar', 'id_bahan_baku', 'jumlah_keluar'
    ];
    protected $primaryKey = 'id_detail_bahan_baku_keluar';
}
