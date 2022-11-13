<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\transaksik;
use App\transaksim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardmasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksim=transaksim::count();
        $transaksik=transaksik::count();   
        return view('admin.dashboard_masuk.index',[
            'transaksim'=>$transaksim,
            'transaksik'=>$transaksik
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

    public function chartku1()
    {
        $pemasukan = DB::table('bahan_baku_masuk')
        ->select(DB::raw('count(id_transaksi_masuk) as data')
        ,DB::raw("MONTH(tanggal_masuk) as month"))
        // ->where("status_transaksi", "Pemasukan")
        ->groupby('month')
        ->get();
        // dd($pemasukan);
        $data["pemasukan"] = $pemasukan;

        return response()->json($data);
    }

    public function chartku2()
    {
        $pengeluaran = DB::table('bahan_baku_keluar')
        ->select(DB::raw('count(id_transaksi_keluar) as data')
        ,DB::raw("MONTH(tanggal_keluar) as month"))
        // ->where("status_transaksi", "Pengeluaran")
        ->groupby('month')
        ->get();
        $data["pengeluaran"] = $pengeluaran;

        return response()->json($data);
    }
}
