<?php

namespace App\Http\Controllers\transaksikeluar;

use App\Http\Controllers\Controller;
use App\transaksik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Carbon;

class TransaksiKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = DB::table('bahan_baku_keluar')
        
        // ->join('bahan_baku', 'bahan_baku_keluar.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
        ->paginate(5);

    return view('admin.bahan_baku_keluar.index', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(session()->has('transaksi')){
            $transaksi = session('transaksi');
        }else{
            $transaksi=[];
        }
        $bahan = DB::table('bahan_baku')->get();
        $bahan2 = DB::table('bahan_baku')->get();
        $kode = transaksik::kode();
        $tanggal = Carbon::now();
        return view('admin.bahan_baku_keluar.tambah', compact('kode', 'bahan', 'transaksi', 'bahan2', 'tanggal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_transaksi_keluar' => 'required',
            'nama_bahan_baku' => 'required',
            'jumlah_keluar'  => 'required|numeric',
            'tanggal_keluar' => 'required',
            'keperluan' => 'required',
        ]);

        $transaksi = [];
        if(!session()->has('transaksi')) {

            $tampung = [
                'id_transaksi_keluar' => $request->get('id_transaksi_keluar'),
                'nama_bahan_baku' => $request->get('nama_bahan_baku'),
                'jumlah_keluar'  => $request->get('jumlah_keluar'),
                'tanggal_keluar' => $request->get('tanggal_keluar'),
                'keperluan' => $request->get('keperluan'),
            ];
            array_push($transaksi,$tampung);
           
            session(['transaksi'=>$transaksi]);

        }else{
            $datatrs = session('transaksi');

            foreach($datatrs as $dts){
                array_push($transaksi,$dts);
            }
            $tampung = [
                'id_transaksi_keluar' => $request->get('id_transaksi_keluar'),
                'nama_bahan_baku' => $request->get('nama_bahan_baku'),
                'jumlah_keluar'  => $request->get('jumlah_keluar'),
                'tanggal_keluar' => $request->get('tanggal_keluar'),
                'keperluan' => $request->get('keperluan'),
            ];
            array_push($transaksi,$tampung);
           
            session(['transaksi'=>$transaksi]);
        }
        return redirect('/bahan_baku_keluar/create')->with('msg', 'Data Bahan Baku Keluar Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bahan = DB::table('bahan_baku_keluar')->where('id_transaksi_keluar', '=', $id)
        // ->join('produk', 'bom.id_produk', '=', 'produk.id_produk')
        ->first();
        
        $detail = DB::table('detail_bahan_baku_keluar')->where('id_transaksi_keluar', '=', $id)
        ->join('bahan_baku', 'detail_bahan_baku_keluar.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
        ->get();
        return view::make('admin.bahan_baku_keluar.detail')->with('bahan', $bahan)->with( 'detail', $detail);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bahan = DB::table('bahan_baku_keluar')->where('id_transaksi_keluar', '=', $id)
        // ->join('produk', 'bom.id_produk', '=', 'produk.id_produk')
        ->first();
        
        $detail = DB::table('detail_bahan_baku_keluar')->where('id_transaksi_keluar', '=', $id)
        ->join('bahan_baku', 'detail_bahan_baku_keluar.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
        ->get();
        return view::make('admin.bahan_baku_keluar.ubah')->with('bahan', $bahan)->with( 'detail', $detail);
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
        DB::table('bahan_baku_keluar')->where('id_transaksi_keluar','=',$id)->delete();
        session()->flash('message', 'Data Bahan Baku Keluar Telah Dihapus');
        return redirect::to('/bahan_baku_keluar');
    }

    public function hapusdata($id)
    {
        $datatrs = session('transaksi');
        $hps = [];
        foreach ($datatrs as $dtb) {
            if ($dtb['nama_bahan_baku'] == $id) {
                unset($dtb);
            } else {
                array_push($hps, $dtb);
            }
        }
        session(['transaksi' => $hps]);
        return redirect('/bahan_baku_keluar/create');
    }

    public function simpandata(Request $request)
    {
        
        $datatrs = session('transaksi');
        $hps = [];
        $tanggalkeluar = $datatrs[0]['tanggal_keluar'];
        $keperluan = $datatrs[0]['keperluan'];
        $transaksi = new transaksik();
        $transaksi->id_transaksi_keluar=$transaksi->kode();
        $transaksi->tanggal_keluar=$tanggalkeluar;
        $transaksi->keperluan=$keperluan;
        $transaksi->save();

        $simpan = DB::table('bahan_baku')->get();
        foreach($simpan as $spn){
           foreach($datatrs as $dts){
               if($spn->id_bahan_baku==$dts['nama_bahan_baku']){
                   DB::table('bahan_baku')->where('id_bahan_baku',$dts['nama_bahan_baku'])->update([
                       'stok'=>$spn->stok-$dts['jumlah_keluar']
                   ]);
                   DB::table('detail_bahan_baku_keluar')->insert([
                      'id_transaksi_keluar'=> $dts['id_transaksi_keluar'],
                       'id_bahan_baku'=>$spn->id_bahan_baku,
                       'jumlah_keluar'=>$dts['jumlah_keluar']
                   ]);
               }
           }
            
        }
        session()->forget('transaksi');
        session()->flash('success', 'Data Transaksi Bahan Baku Keluar Berhasil Di Tambahkan');
        return redirect('/bahan_baku_keluar');
    }
}
