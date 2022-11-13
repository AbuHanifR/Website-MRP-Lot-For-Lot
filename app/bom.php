<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class bom extends Model
{
    protected $table = 'bom';
    protected $fillable = [
        'id_bom', 'id_produk', 'id_bahan_baku', 'jumlah_bahan'
    ];

    public function bahan (){
        return $this->belongsTo('App\bahan','id_bahan_baku');
    }
    public function produk (){
        return $this->belongsTo('App\produk','id_produk');
    }

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'id_bom';

    public static function kode(){
        $kode = DB::table('bom')->max('id_bom');
        $addNol = '';
        $kode = str_replace("BOM","",$kode);
        $kode = (int) $kode +1;
        $incrementKode = $kode;

        if(strlen($kode)==1){
            $addNol = "000";
        }elseif (strlen($kode) == 2) {
    		$addNol = "00";
    	} elseif (strlen($kode == 3)) {
    		$addNol = "0";
        }
        $kodeBaru = "BOM".$addNol.$incrementKode;
    	return $kodeBaru;
    }
}
