<?php

namespace App\Http\Controllers\dashboard;

use App\bahan;
use App\bom;
use App\Http\Controllers\Controller;
use App\pesanan;
use App\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardppicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk=produk::count();
        $bom=bom::count();
        $bahan=bahan::count();
        $pesanan=pesanan::count();   
        return view('admin.dashboard_ppic.index',[
            'produk'=>$produk,
            'bom'=>$bom,
            'bahan'=>$bahan,
            'pesanan'=>$pesanan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function chartku()
    {
        $pemesanan = DB::table('penerimaan_pesanan')
        ->select(DB::raw('count(id_pesanan) as data')
        ,DB::raw("MONTH(tanggal_pesanan) as month"))
        // ->where("status_transaksi", "Pemasukan")
        ->groupby('month')
        ->get();
        // dd($pemasukan);
        $data["pemesanan"] = $pemesanan;

        return response()->json($data);
    }
}
