<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pesanan extends Model
{
    protected $table = 'penerimaan_pesanan';
    protected $fillable = [
        'id_pesanan', 'tanggal_pesanan', 'jadwal_produksi'
    ];

    public function produk (){
        return $this->belongsTo('App\produk','id_produk');
    }

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'id_pesanan';

    public static function kode(){
        $kode = DB::table('penerimaan_pesanan')->max('id_pesanan');
        $addNol = '';
        $kode = str_replace("PSN","",$kode);
        $kode = (int) $kode +1;
        $incrementKode = $kode;

        if(strlen($kode)==1){
            $addNol = "000";
        }elseif (strlen($kode) == 2) {
    		$addNol = "00";
    	} elseif (strlen($kode == 3)) {
    		$addNol = "0";
        }
        $kodeBaru = "PSN".$addNol.$incrementKode;
    	return $kodeBaru;
    }

}
