<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detailmps extends Model
{
    protected $table = 'detail_mps';
    protected $fillable = [
        'id_detail_mps', 'id_mps', 'id_pesanan', 'jadwal_detail_produksi'
    ];
    protected $primaryKey = 'id_detail_mps';
}
