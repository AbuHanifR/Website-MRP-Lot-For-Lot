<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class mps extends Model
{
    protected $table = 'mps';
    protected $fillable = [
        'id_mps', 'id_produk', 'bulan', 'minggu_1', 'minggu_2', 'minggu_3', 'minggu_4'
    ];

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'id_mps';

    public static function kode(){
        $kode = DB::table('mps')->max('id_mps');
        $addNol = '';
        $kode = str_replace("MPS","",$kode);
        $kode = (int) $kode +1;
        $incrementKode = $kode;

        if(strlen($kode)==1){
            $addNol = "000";
        }elseif (strlen($kode) == 2) {
    		$addNol = "00";
    	} elseif (strlen($kode == 3)) {
    		$addNol = "0";
        }
        $kodeBaru = "MPS".$addNol.$incrementKode;
    	return $kodeBaru;
    }
}
