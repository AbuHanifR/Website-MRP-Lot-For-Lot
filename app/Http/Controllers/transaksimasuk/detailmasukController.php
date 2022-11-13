<?php

namespace App\Http\Controllers\transaksimasuk;

use App\bahan;
use App\detailbahanbakumasuk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class detailmasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $bahan = DB::table('bahan_baku')->get();
        // dd($bahan);
        $detail = DB::table('detail_bahan_baku_masuk')->where('id_detail_bahan_baku_masuk', '=', $id)
        ->join('bahan_baku', 'detail_bahan_baku_masuk.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
        ->first();

        $data = DB::table('bahan_baku_masuk')->where('id_transaksi_masuk', '=', $detail->id_transaksi_masuk)
        // ->join('produk', 'bom.id_produk', '=', 'produk.id_produk')
        ->first();

        return view::make('admin.bahan_baku_masuk.detailubah')->with( 'detail', $detail)->with( 'bahan', $bahan)->with( 'data', $data);

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
        $this->validate($request, [
            'jumlah_masuk' => 'required|numeric'
        ]);

        $data = detailbahanbakumasuk::where('id_detail_bahan_baku_masuk', '=', $id)->first();
        $kurang = $request->get('jumlah_masuk')-$data->jumlah_masuk;
        $bahan = bahan::where('id_bahan_baku', $data->id_bahan_baku)->first();
        $bahan->stok=$kurang+$bahan->stok;
        $bahan->save();
        $data->jumlah_masuk = $request->get('jumlah_masuk');
        
        $data->save();
        session()->flash('success', 'Data Transaksi Bahan Baku Masuk Berhasil Di Ubah');
        return redirect('bahan_baku_masuk')->with('msg', 'Berhasil Mengubah Data Bahan Baku Masuk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('detail_bahan_baku_masuk')->where('id_detail_bahan_baku_masuk','=',$id)->delete();
        session()->flash('message', 'Data Bahan Baku Masuk Telah Dihapus');
        return redirect::to('/bahan_baku_masuk');
    }
}
