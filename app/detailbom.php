<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detailbom extends Model
{
    protected $table = 'detail_bom';
    protected $fillable = [
        'id_detail_bom', 'id_bom', 'jumlah_bahan'
    ];
    protected $primaryKey = 'id_detail_bom';
    
}
