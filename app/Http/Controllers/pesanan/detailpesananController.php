<?php

namespace App\Http\Controllers\pesanan;

use App\detailpesanan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class detailpesananController extends Controller
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
        $produk = DB::table('produk')->get();
        $detail = DB::table('detail_pesanan')->where('id_detail_pesanan', '=', $id)
        ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id_produk')
        ->first();

        $data = DB::table('penerimaan_pesanan')->where('id_pesanan', '=', $detail->id_pesanan)
        ->first();

        return view::make('admin.pesanan.detailubah')->with( 'detail', $detail)->with( 'produk', $produk)->with( 'data', $data);
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
            'jumlah_pesanan' => 'required|numeric'
        ]);

        $data = detailpesanan::where('id_detail_pesanan', '=', $id)->first();
        $data->jumlah_pesanan = $request->get('jumlah_pesanan');
        $data->save();
        
        session()->flash('success', 'Data Pesanan Berhasil Di Ubah');
        return redirect('pesanan')->with('msg', 'Berhasil Mengubah Data Pesanan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('detail_pesanan')->where('id_detail_pesanan','=',$id)->delete();
        session()->flash('message', 'Data Pesanan Telah Dihapus');
        return redirect::to('/pesanan');
    }
    
}
