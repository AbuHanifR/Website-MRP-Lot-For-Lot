<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detailmrp extends Model
{
    protected $table = 'detail_mrp';
    protected $fillable = [
        'id_detail_mrp', 'id_mrp', 'id_mps', 'id_bom'
    ];
    protected $primaryKey = 'id_detail_mrp';
    public function convert_bulan ($tanggal){
        $exp = \explode('-', $tanggal);
        return $exp[1];
    }
}

