<?php

namespace App\Http\Controllers\transaksikeluar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class LaporanKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $laporan = DB::table('detail_bahan_baku_keluar')
            ->join('bahan_baku_keluar', 'detail_bahan_baku_keluar.id_transaksi_keluar', '=', 'bahan_baku_keluar.id_transaksi_keluar')
            ->join('bahan_baku', 'detail_bahan_baku_keluar.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
            ->paginate(10);

        if ($request->has('filter')) {
            $bulan = date('m', strtotime($request->get('filter')));
            $laporan = DB::table('detail_bahan_baku_keluar')
            ->join('bahan_baku_keluar', 'detail_bahan_baku_keluar.id_transaksi_keluar', '=', 'bahan_baku_keluar.id_transaksi_keluar')
            ->join('bahan_baku', 'detail_bahan_baku_keluar.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
            ->whereMonth('bahan_baku_keluar.tanggal_keluar', $bulan)
            ->paginate(10);
            session(['filter'=>$request->get('filter')]);
        }
        // dd($request['cetak']);
        if ($request->has('filter') && $request->get('status') == 'cetak') {
            $bulan = date('m', strtotime($request->get('filter')));
            $laporan = DB::table('detail_bahan_baku_keluar')
            ->join('bahan_baku_keluar', 'detail_bahan_baku_keluar.id_transaksi_keluar', '=', 'bahan_baku_keluar.id_transaksi_keluar')
            ->join('bahan_baku', 'detail_bahan_baku_keluar.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
            ->whereMonth('bahan_baku_keluar.tanggal_keluar', $bulan)
                ->get();
            $pdf = PDF::loadview("admin.laporan_keluar.cetak", [

                'laporan' => $laporan,


            ]);
            return $pdf->download("laporan_keluar.pdf");
        }
        session()->flashInput($request->input());
        return view('admin.laporan_keluar.index', compact('laporan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function filter(Request $request)
    {
        // menangkap data pencarian
        $filter = $request->filter;

        // mengambil data dari table sesuai pencarian data
        $laporan = DB::table('detail_bahan_baku_keluar')
            ->join('bahan_baku_keluar', 'detail_bahan_baku_keluar.id_transaksi_keluar', '=', 'bahan_baku_keluar.id_transaksi_keluar')
            ->join('bahan_baku', 'detail_bahan_baku_keluar.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
            ->where('bahan_baku_keluar.tanggal_keluar', 'like', "%" . $filter . "%")
            ->paginate(10);
        //   dd($masuk);

        // mengirim data ke view index
        return view('admin.laporan_keluar.index', compact('laporan'));
    }
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
