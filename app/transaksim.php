<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class transaksim extends Model
{
    protected $table = 'bahan_baku_masuk';
    protected $fillable = [
        'id_transaksi_masuk', 'tanggal_masuk'
    ];
    public function bahan (){
        return $this->belongsTo('App\bahan','id_bahan_baku');
    }

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'id_transaksi_masuk';

    public static function kode(){
        $kode = DB::table('bahan_baku_masuk')->max('id_transaksi_masuk');
        $addNol = '';
        $kode = str_replace("TRS","",$kode);
        $kode = (int) $kode +1;
        $incrementKode = $kode;

        if(strlen($kode)==1){
            $addNol = "000";
        }elseif (strlen($kode) == 2) {
    		$addNol = "00";
    	} elseif (strlen($kode == 3)) {
    		$addNol = "0";
        }
        $kodeBaru = "TRS".$addNol.$incrementKode;
    	return $kodeBaru;
    }
}
