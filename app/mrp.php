<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class mrp extends Model
{
    protected $table = 'mrp';
    protected $fillable = [
        'id_mrp', 'id_produk', 'bulan_mrp', 'GR', 
        'SR', 'OHI', 'NR', 'POR', 'PORel'
    ];

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'id_mrp';

    public static function kode(){
        $kode = DB::table('mrp')->max('id_mrp');
        $addNol = '';
        $kode = str_replace("MRP","",$kode);
        $kode = (int) $kode +1;
        $incrementKode = $kode;

        if(strlen($kode)==1){
            $addNol = "000";
        }elseif (strlen($kode) == 2) {
    		$addNol = "00";
    	} elseif (strlen($kode == 3)) {
    		$addNol = "0";
        }
        $kodeBaru = "MRP".$addNol.$incrementKode;
    	return $kodeBaru;
    }
}
