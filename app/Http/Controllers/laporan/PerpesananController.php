<?php

namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PerpesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $produk = DB::table('produk')->get();

        $laporan = DB::table('detail_pesanan')
            ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id_produk')
            ->join('bom', 'bom.id_produk', '=', 'produk.id_produk')
            ->join('detail_bom', 'bom.id_bom', '=', 'detail_bom.id_bom')
            ->join('bahan_baku', 'detail_bom.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
            ->join('penerimaan_pesanan', 'detail_pesanan.id_pesanan', '=', 'penerimaan_pesanan.id_pesanan')
            ->orderBy('jadwal_produksi', 'asc')
            ->paginate(10);

            if ($request->has('filter')) {
                // $bulan = date('m',strtotime($request->get('filter')));
                $laporan = DB::table('detail_pesanan')
                ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id_produk')
                ->join('bom', 'bom.id_produk', '=', 'produk.id_produk')
                ->join('detail_bom', 'bom.id_bom', '=', 'detail_bom.id_bom')
                ->join('bahan_baku', 'detail_bom.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
                ->join('penerimaan_pesanan', 'detail_pesanan.id_pesanan', '=', 'penerimaan_pesanan.id_pesanan')
                ->where('detail_pesanan.id_produk', '=', $request->id_produk)
                ->whereYear('penerimaan_pesanan.jadwal_produksi', $request->filter)
                ->orderBy('jadwal_produksi', 'asc')
                ->paginate(10);
                session(['filter'=>$request->get('filter'), 'id_produk' => $request->get('id_produk')]);
            }
            // dd($request['cetak']);
            if ($request->has('filter') && $request->get('status')=='cetak') {
                $produk_cetak = DB::table('produk')
                ->where('id_produk', $request->id_produk)
                ->first();
                $laporan = DB::table('detail_pesanan')
                ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id_produk')
                ->join('bom', 'bom.id_produk', '=', 'produk.id_produk')
                ->join('detail_bom', 'bom.id_bom', '=', 'detail_bom.id_bom')
                ->join('bahan_baku', 'detail_bom.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
                ->join('penerimaan_pesanan', 'detail_pesanan.id_pesanan', '=', 'penerimaan_pesanan.id_pesanan')
                ->where('detail_pesanan.id_produk', '=', $request->id_produk)
                ->whereYear('penerimaan_pesanan.jadwal_produksi', $request->filter)
                ->orderBy('jadwal_produksi', 'asc')
                ->get();
                    $pdf = PDF::loadview("admin.laporan_perpesanan.cetak", [
    
                        'laporan' => $laporan, 'produk_cetak' => $produk_cetak, 'year' => $request->filter,
                    ]);
                    return $pdf->download("laporan_perpesanan.pdf");
            }
            session()->flashInput($request->input());
        return view('admin.laporan_perpesanan.index', compact('laporan', 'produk'));
    }

    public function filter(Request $request)
    {
        // menangkap data pencarian
        $filter = $request->filter;
        $id_produk = $request->id_produk;

        // mengambil data dari table pegawai sesuai pencarian data
        $laporan = DB::table('detail_pesanan')
            ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id_produk')
            ->join('bom', 'bom.id_produk', '=', 'produk.id_produk')
            ->join('detail_bom', 'bom.id_bom', '=', 'detail_bom.id_bom')
            ->join('bahan_baku', 'detail_bom.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
            ->join('penerimaan_pesanan', 'detail_pesanan.id_pesanan', '=', 'penerimaan_pesanan.id_pesanan')
            ->where('produk.id_produk', '=', $id_produk)
            ->where('penerimaan_pesanan.jadwal_produksi', 'like', "%" . $filter . "%")
            ->paginate(3);
        //   dd($masuk);

        // mengirim data ke view index
        return view('admin.laporan_perpesanan.index', compact('laporan'));
        
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
