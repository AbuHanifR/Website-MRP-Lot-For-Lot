<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detaillaporanmps extends Model
{
    protected $table = 'detail_mps';
    protected $fillable = [
        'id_detail_mps', 'id_mps', 'id_pesanan', 'jadwal_produksi'
    ];
    protected $primaryKey = 'id_detail_mps';
}
