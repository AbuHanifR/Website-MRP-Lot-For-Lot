<?php

namespace App\Http\Controllers\mps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use PDF;

class LaporanMPSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laporan = DB::table('mps')
            ->join('produk', 'mps.id_produk', '=', 'produk.id_produk')
            ->paginate(10);
        // dd($produk);
        return view('admin.laporan_mps.index', compact('laporan'));
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
    public function detail($id)
    {
        $pesanan = DB::table('mps')->where('id_mps', '=', $id)
            ->join('produk', 'mps.id_produk', '=', 'produk.id_produk')
            ->first();
        // dd($pesanan);

        $detail = DB::table('detail_mps')->where('id_mps', '=', $id)
            ->join('detail_pesanan', 'detail_mps.id_detail_pesanan', '=', 'detail_pesanan.id_detail_pesanan')
            ->get();
        // dd($detail);

        return view::make('admin.laporan_mps.detail')->with('pesanan', $pesanan)->with('detail', $detail);
    }

    public function cetakpdf($id)
    {
        $pesanan = DB::table('mps')->where('id_mps', '=', $id)
            ->join('produk', 'mps.id_produk', '=', 'produk.id_produk')
            ->first();
        // dd($pesanan);

        $detail = DB::table('detail_mps')->where('id_mps', '=', $id)
            ->join('detail_pesanan', 'detail_mps.id_detail_pesanan', '=', 'detail_pesanan.id_detail_pesanan')
            ->get();

        $pdf = PDF::loadview("admin/laporan_mps/cetak", [
            'pesanan' => $pesanan,
            'detail' => $detail

        ]);
        return $pdf->download("laporan_mps.pdf");
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
}
