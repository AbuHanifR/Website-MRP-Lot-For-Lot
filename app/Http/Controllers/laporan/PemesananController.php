<?php

namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $laporan = DB::table('detail_mrp')
            ->join('detail_bom', 'detail_mrp.id_detail_bom', '=', 'detail_bom.id_detail_bom')
            ->join('bahan_baku', 'detail_bom.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
            ->where('PORel', '>' , 0)
            ->orderBy('bulan_mrp', 'asc')
            ->paginate(10);

        if ($request->has('filter')) {
            $bulan = date('m', strtotime($request->get('filter')));
            $laporan = DB::table('detail_mrp')
                ->join('detail_bom', 'detail_mrp.id_detail_bom', '=', 'detail_bom.id_detail_bom')
                ->join('bahan_baku', 'detail_bom.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
                ->whereMonth('detail_mrp.bulan_mrp', $bulan)
                ->where('PORel', '>' , 0)
                ->orderBy('bulan_mrp', 'asc')
                ->paginate(10);
                session(['filter'=>$request->get('filter')]);
        }
        // dd($request['cetak']);
        if ($request->has('filter') && $request->get('status') == 'cetak') {
            $bulan = date('m', strtotime($request->get('filter')));
            $laporan = DB::table('detail_mrp')
                ->join('detail_bom', 'detail_mrp.id_detail_bom', '=', 'detail_bom.id_detail_bom')
                ->join('bahan_baku', 'detail_bom.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
                ->whereMonth('detail_mrp.bulan_mrp', $bulan)
                ->where('PORel', '>' , 0)
                ->orderBy('bulan_mrp', 'asc')
                ->get();
            $pdf = PDF::loadview("admin.laporan_pemesanan.cetak", [

                'laporan' => $laporan,
            ]);
            return $pdf->download("laporan_pemesanan.pdf");
        }
        session()->flashInput($request->input());
        return view('admin.laporan_pemesanan.index', compact('laporan'));
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
