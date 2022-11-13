<?php

namespace App\Http\Controllers\transaksimasuk;

use App\Http\Controllers\Controller;
use App\transaksim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Carbon;

class TransaksiMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = DB::table('bahan_baku_masuk')
        // ->join('bahan_baku', 'bahan_baku_masuk.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
        ->paginate(5);

    return view('admin.bahan_baku_masuk.index', compact('transaksi'));
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
        $kode = transaksim::kode();
        $tanggal = Carbon::now();
        return view('admin.bahan_baku_masuk.tambah', compact('kode', 'bahan', 'transaksi', 'bahan2', 'tanggal'));
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
            'id_transaksi_masuk' => 'required',
            'nama_bahan_baku' => 'required',
            'jumlah_masuk'  => 'required|numeric',
            'tanggal_masuk' => 'required',
        ]);

        $transaksi = [];
        if(!session()->has('transaksi')) {
             
            $tampung = [
                'id_transaksi_masuk' => $request->get('id_transaksi_masuk'),
                'nama_bahan_baku' => $request->get('nama_bahan_baku'),
                'jumlah_masuk'  => $request->get('jumlah_masuk'),
                'tanggal_masuk' => $request->get('tanggal_masuk'),
            ];
            array_push($transaksi,$tampung);
           
            session(['transaksi'=>$transaksi]);

        }else{
            $datatrs = session('transaksi');
         
          
            foreach($datatrs as $dts){
                array_push($transaksi,$dts);
            }
            $tampung = [
                'id_transaksi_masuk' => $request->get('id_transaksi_masuk'),
                'nama_bahan_baku' => $request->get('nama_bahan_baku'),
                'jumlah_masuk'  => $request->get('jumlah_masuk'),
                'tanggal_masuk' => $request->get('tanggal_masuk'),
            ];
            array_push($transaksi,$tampung);
           
            session(['transaksi'=>$transaksi]);
        }
        return redirect('/bahan_baku_masuk/create')->with('msg', 'Data Bahan Baku Masuk Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bahan = DB::table('bahan_baku_masuk')->where('id_transaksi_masuk', '=', $id)
        // ->join('produk', 'bom.id_produk', '=', 'produk.id_produk')
        ->first();
        
        $detail = DB::table('detail_bahan_baku_masuk')->where('id_transaksi_masuk', '=', $id)
        ->join('bahan_baku', 'detail_bahan_baku_masuk.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
        ->get();
        return view::make('admin.bahan_baku_masuk.detail')->with('bahan', $bahan)->with( 'detail', $detail);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bahan = DB::table('bahan_baku_masuk')->where('id_transaksi_masuk', '=', $id)
        // ->join('produk', 'bom.id_produk', '=', 'produk.id_produk')
        ->first();
        
        $detail = DB::table('detail_bahan_baku_masuk')->where('id_transaksi_masuk', '=', $id)
        ->join('bahan_baku', 'detail_bahan_baku_masuk.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
        ->get();
        return view::make('admin.bahan_baku_masuk.ubah')->with('bahan', $bahan)->with( 'detail', $detail);
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
        // $hapus = DB::table('bahan_baku_masuk')->where('id_transaksi_masuk', '=', $id)->first();

        // $bahanbk = DB::table('bahan_baku')->where('id_bahan_baku', '=', $hapus->id_bahan_baku)->first();
        // $bahanbk = DB::table('bahan_baku')->where('id_bahan_baku', '=', $hapus->id_bahan_baku)->update(['stok' => $bahanbk->stok - $hapus->jumlah_masuk]);
        
        // $hapus = DB::table('bahan_baku_masuk')->where('id_transaksi_masuk', '=', $id)->delete();
        // session()->flash('message', 'Data Bahan Baku Masuk Telah Dihapus');
        // return redirect::to('/bahan_baku_masuk')->with('msg', 'Berhasil Menghapus Data Bahan Baku Masuk');
        DB::table('bahan_baku_masuk')->where('id_transaksi_masuk','=',$id)->delete();
        session()->flash('message', 'Data Bahan Baku Masuk Telah Dihapus');
        return redirect::to('/bahan_baku_masuk');
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
        return redirect('/bahan_baku_masuk/create');
    }

    public function simpandata(Request $request)
    {
        $datatrs = session('transaksi');
        $hps = [];
        $tanggalmasuk = $datatrs[0]['tanggal_masuk'];
        $transaksi = new transaksim();
        $transaksi->id_transaksi_masuk=$transaksi->kode();
        $transaksi->tanggal_masuk=$tanggalmasuk;
        $transaksi->save();

        $simpan = DB::table('bahan_baku')->get();
        foreach($simpan as $spn){
           foreach($datatrs as $dts){
               if($spn->id_bahan_baku==$dts['nama_bahan_baku']){
                   DB::table('bahan_baku')->where('id_bahan_baku',$dts['nama_bahan_baku'])->update([
                       'stok'=>$spn->stok+$dts['jumlah_masuk']
                   ]);
                   DB::table('detail_bahan_baku_masuk')->insert([
                      'id_transaksi_masuk'=> $dts['id_transaksi_masuk'],
                       'id_bahan_baku'=>$spn->id_bahan_baku,
                       'jumlah_masuk'=>$dts['jumlah_masuk']
                   ]);
               }
           }
            
        }
        session()->forget('transaksi');
        session()->flash('success', 'Data Transaksi Bahan Baku Masuk Berhasil Di Tambahkan');
        return redirect('/bahan_baku_masuk');
    }
}
