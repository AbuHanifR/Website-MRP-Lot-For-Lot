<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class bahan extends Model
{
    protected $table = 'bahan_baku';
    protected $fillable = [
        'nama_bahan_baku', 'satuan', 'stok'
    ];


	
    protected $primaryKey = 'id_bahan_baku';
    public $timestamps = false;
    public $incrementing = false;
    
    public static function kode()
    {
    	$kode = DB::table('bahan_baku')->max('id_bahan_baku');
    	$addNol = '';
    	$kode = str_replace("BBK", "", $kode);
    	$kode = (int) $kode + 1;
        $incrementKode = $kode;

    	if (strlen($kode) == 1) {
    		$addNol = "000";
    	} elseif (strlen($kode) == 2) {
    		$addNol = "00";
    	} elseif (strlen($kode == 3)) {
    		$addNol = "0";
    	}

    	$kodeBaru = "BBK".$addNol.$incrementKode;
    	return $kodeBaru;
    }

	public function bom (){
        return $this->hasMany('App\bom','id_bahan_baku');
    }
}
