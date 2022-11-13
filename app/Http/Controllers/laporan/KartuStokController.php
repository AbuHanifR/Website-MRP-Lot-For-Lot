<?php

namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class KartuStokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $laporan = DB::table('detail_bahan_baku_masuk')
            ->join('bahan_baku_masuk', 'detail_bahan_baku_masuk.id_transaksi_masuk', '=', 'bahan_baku_masuk.id_transaksi_masuk')
            ->join('bahan_baku', 'detail_bahan_baku_masuk.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
            ->paginate(10);


        $laporan2 = DB::table('detail_bahan_baku_keluar')
            ->join('bahan_baku_keluar', 'detail_bahan_baku_keluar.id_transaksi_keluar', '=', 'bahan_baku_keluar.id_transaksi_keluar')
            ->join('bahan_baku', 'detail_bahan_baku_keluar.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
            ->paginate(10);

        if ($request->has('filter')) {
            $bulan = date('m', strtotime($request->get('filter')));
            $laporan = DB::table('detail_bahan_baku_masuk')
                ->join('bahan_baku_masuk', 'detail_bahan_baku_masuk.id_transaksi_masuk', '=', 'bahan_baku_masuk.id_transaksi_masuk')
                ->join('bahan_baku', 'detail_bahan_baku_masuk.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
                ->whereMonth('bahan_baku_masuk.tanggal_masuk', $bulan)
                ->paginate(10);
            session(['filter' => $request->get('filter')]);

            $laporan2 = DB::table('detail_bahan_baku_keluar')
                ->join('bahan_baku_keluar', 'detail_bahan_baku_keluar.id_transaksi_keluar', '=', 'bahan_baku_keluar.id_transaksi_keluar')
                ->join('bahan_baku', 'detail_bahan_baku_keluar.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
                ->whereMonth('bahan_baku_keluar.tanggal_keluar', $bulan)
                ->paginate(10);
            session(['filter' => $request->get('filter')]);
        }

        if ($request->has('filter') && $request->get('status') == 'cetak') {
            $bulan = date('m', strtotime($request->get('filter')));


            $laporan = DB::table('detail_bahan_baku_masuk')
                ->join('bahan_baku_masuk', 'detail_bahan_baku_masuk.id_transaksi_masuk', '=', 'bahan_baku_masuk.id_transaksi_masuk')
                ->join('bahan_baku', 'detail_bahan_baku_masuk.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
                ->whereMonth('bahan_baku_masuk.tanggal_masuk', $bulan)
                ->get();

            $laporan2 = DB::table('detail_bahan_baku_keluar')
                ->join('bahan_baku_keluar', 'detail_bahan_baku_keluar.id_transaksi_keluar', '=', 'bahan_baku_keluar.id_transaksi_keluar')
                ->join('bahan_baku', 'detail_bahan_baku_keluar.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
                ->whereMonth('bahan_baku_keluar.tanggal_keluar', $bulan)
                ->get();
            $pdf = PDF::loadview("admin.kartu_stok.cetak", [

                'laporan' => $laporan,
                'laporan2' => $laporan2


            ]);
            return $pdf->download("kartu_stok.pdf");
        }

        // $laporan = $laporan->merge($laporan2);
        // dd($laporan);
        session()->flashInput($request->input());
        return view('admin.kartu_stok.index', compact('laporan', 'laporan2'));
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
}
