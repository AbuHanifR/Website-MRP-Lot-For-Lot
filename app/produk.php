<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class produk extends Model
{
    protected $table = 'produk';
    protected $fillable = [
        'nama_produk'
    ];

    protected $primaryKey = 'id_produk';
    public $timestamps = false;
    public $incrementing = false;

    public static function kode()
    {
    	$kode = DB::table('produk')->max('id_produk');
    	$addNol = '';
    	$kode = str_replace("PRD", "", $kode);
    	$kode = (int) $kode + 1;
        $incrementKode = $kode;

    	if (strlen($kode) == 1) {
    		$addNol = "000";
    	} elseif (strlen($kode) == 2) {
    		$addNol = "00";
    	} elseif (strlen($kode == 3)) {
    		$addNol = "0";
    	}

    	$kodeBaru = "PRD".$addNol.$incrementKode;
    	return $kodeBaru;
    }
}
