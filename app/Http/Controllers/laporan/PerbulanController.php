<?php

namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PerbulanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $laporan = DB::table('detail_pesanan')
            ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id_produk')
            ->join('bom', 'bom.id_produk', '=', 'produk.id_produk')
            ->join('detail_bom', 'bom.id_bom', '=', 'detail_bom.id_bom')
            ->join('bahan_baku', 'detail_bom.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
            ->join('penerimaan_pesanan', 'detail_pesanan.id_pesanan', '=', 'penerimaan_pesanan.id_pesanan')
            // ->selectRaw('nama_bahan_baku, sum(jumlah_bahan*jumlah_pesanan) as total, year(jadwal_produksi) as year, monthname(jadwal_produksi) as month')
            // ->groupBy('nama_bahan_baku', 'month', 'year')
            ->paginate(10);
        if ($request->has('filter')) {
            $bulan = date('m',strtotime($request->get('filter')));
            $laporan = DB::table('detail_pesanan')
                ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id_produk')
                ->join('bom', 'bom.id_produk', '=', 'produk.id_produk')
                ->join('detail_bom', 'bom.id_bom', '=', 'detail_bom.id_bom')
                ->join('bahan_baku', 'detail_bom.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
                ->join('penerimaan_pesanan', 'detail_pesanan.id_pesanan', '=', 'penerimaan_pesanan.id_pesanan')
                // ->selectRaw('nama_bahan_baku, sum(jumlah_bahan*jumlah_pesanan) as total, year(jadwal_produksi) as year, monthname(jadwal_produksi) as month')
                ->whereMonth('jadwal_produksi', $bulan)
                // ->groupBy('nama_bahan_baku', 'month', 'year')
                ->paginate(10);
        }
        // dd($request['cetak']);
        if ($request->has('filter') && $request->get('status')=='cetak') {
            $bulan = date('m',strtotime($request->get('filter')));
            $month = date('F',strtotime($request->get('filter')));
            $year = date('Y',strtotime($request->get('filter')));
            $laporan = DB::table('detail_pesanan')
                ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id_produk')
                ->join('bom', 'bom.id_produk', '=', 'produk.id_produk')
                ->join('detail_bom', 'bom.id_bom', '=', 'detail_bom.id_bom')
                ->join('bahan_baku', 'detail_bom.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
                ->join('penerimaan_pesanan', 'detail_pesanan.id_pesanan', '=', 'penerimaan_pesanan.id_pesanan')
                // ->selectRaw('nama_bahan_baku ,sum(jumlah_bahan*jumlah_pesanan) as total, year(jadwal_produksi) as year, monthname(jadwal_produksi) as month')
                ->whereMonth('jadwal_produksi', $bulan)
                // ->groupBy('nama_bahan_baku', 'month', 'year')
                ->get();
                $pdf = PDF::loadview("admin.laporan_perbulan.cetak", [

                    'laporan' => $laporan,
                    'month' => $month,
                    'year' => $year,
                   
        
                ]);
                return $pdf->download("laporan_perbulan.pdf");
        }
        // dd($laporan);
        session()->flashInput($request->input());
        return view('admin.laporan_perbulan.index', compact('laporan'));
    }

    public function filter2(Request $request)
    {
        // menangkap data pencarian
        $filter = $request->filter;

        // mengambil data dari table pegawai sesuai pencarian data
        $laporan = DB::table('detail_pesanan')
            ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id_produk')
            ->join('bom', 'bom.id_produk', '=', 'produk.id_produk')
            ->join('detail_bom', 'bom.id_bom', '=', 'detail_bom.id_bom')
            ->join('bahan_baku', 'detail_bom.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
            ->join('penerimaan_pesanan', 'detail_pesanan.id_pesanan', '=', 'penerimaan_pesanan.id_pesanan')
            ->where('penerimaan_pesanan.jadwal_produksi', 'like', "%" . $filter . "%")
            ->paginate(5);
        //   dd($masuk);

        // mengirim data ke view index
        return view('admin.laporan_perbulan.index', compact('laporan'));
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
