<?php

namespace App\Http\Controllers\pesanan;

use App\Http\Controllers\Controller;
use App\pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesanan = DB::table('penerimaan_pesanan')
            ->paginate(10);

        return view('admin.pesanan.index', compact('pesanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (session()->has('pesanan')) {
            $pesanan = session('pesanan');
        } else {
            $pesanan = [];
        }
        if(!empty($pesanan)){
            $jadwalproduksi = $pesanan[0]['jadwal_produksi'];
        }else{
            $jadwalproduksi = '';
        }
        
        $produk = DB::table('produk')->get();
        $produk2 = DB::table('produk')->get();
        $kode = pesanan::kode();
        $tanggal = Carbon::now();

        return view('admin.pesanan.tambah', ['kode'=>$kode, 'produk'=>$produk, 'produk2'=>$produk2, 'pesanan'=>$pesanan, 'tanggal'=>$tanggal, 'jadwal_produksi'=>$jadwalproduksi]);
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
            'tanggal_produksi' => 'required',
            'nama_produk' => 'required',
            'jumlah_pesanan' => 'required|numeric',
        ]);

        $pesanan = [];
        if (!session()->has('pesanan')) {
        
            $tampung = [
                'id_pesanan' => $request->get('id_pesanan'),
                'nama_produk' => $request->get('nama_produk'),
                'tanggal_pesanan' => $request->get('tanggal_pesanan'),
                'jadwal_produksi' => $request->get('tanggal_produksi'),
                'jumlah_pesanan' => $request->get('jumlah_pesanan'),
            ];
            array_push($pesanan, $tampung);

            session(['pesanan' => $pesanan]);
        }else{
            $datapesanan = session('pesanan');

            foreach($datapesanan as $dtp){
                array_push($pesanan, $dtp);
            }
            $tampung = [
                'id_pesanan' => $request->get('id_pesanan'),
                'nama_produk' => $request->get('nama_produk'),
                'tanggal_pesanan' => $request->get('tanggal_pesanan'),
                'jadwal_produksi' => $request->get('tanggal_produksi'),
                'jumlah_pesanan' => $request->get('jumlah_pesanan'),
            ];

            array_push($pesanan, $tampung);

            session(['pesanan' => $pesanan]);
        }
        return redirect('/pesanan/create')->with('msg', 'Data Pesanan Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = DB::table('penerimaan_pesanan')->where('id_pesanan', '=', $id)
        // ->join('produk', 'bom.id_produk', '=', 'produk.id_produk')
        ->first();
        
        $detail = DB::table('detail_pesanan')->where('id_pesanan', '=', $id)
        ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id_produk')
        ->get();
        return view::make('admin.pesanan.ubah')->with('produk', $produk)->with( 'detail', $detail);
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
        // DB::table('penerimaan_pesanan')->where('id_pesanan','=',$id)->delete();
        // session()->flash('message', 'Data Pesanan Telah Dihapus');
        // return redirect::to('/pesanan');

        $pesanan = DB::table('detail_pesanan')->where('id_pesanan', '=', $id)->first();
        $jumlah_pesanan = DB::table('detail_mps')->where('id_detail_pesanan', '=', $pesanan->id_detail_pesanan)->count();
       
        if ($jumlah_pesanan > 0 ) {
            return redirect('pesanan')->with('message', 'Data Pesanan Tidak Bisa Di Hapus');
        } else {
            DB::table('penerimaan_pesanan')->where('id_pesanan', '=', $id)->delete();
            session()->flash('message', 'Data Pesanan Telah Dihapus');
            return redirect::to('/pesanan');
        }
    }

    public function hapusdata($id)
    {
        $datapesanan = session('pesanan');
        $hps = [];
        foreach ($datapesanan as $dtp) {
            if ($dtp['nama_produk'] == $id) {
                unset($dtp);
            } else {
                array_push($hps, $dtp);
            }
        }
        session(['pesanan' => $hps]);
        return redirect('/pesanan/create');
    }

    public function simpandata(Request $request)
    {
        $datapesanan = session('pesanan');
        $hps = [];
        $tanggalpesanan = $request->tanggal_pesanan;
        $jadwalproduksi = $request->jadwal_produksi;
        $pesanan = new pesanan();
        $pesanan->id_pesanan=$pesanan->kode();
        $pesanan->tanggal_pesanan=$tanggalpesanan;
        $pesanan->jadwal_produksi=$jadwalproduksi;
        $pesanan->save();

        foreach ($datapesanan as $dtp) {
            DB::table('detail_pesanan')->insert([
                'id_pesanan' => $request->id_pesanan,
                'id_produk' => $dtp['nama_produk'],
                'jumlah_pesanan' => $dtp['jumlah_pesanan'],
            ]);
        }
        session()->forget('pesanan');
        session()->flash('success', 'Data Pesanan Berhasil Di Tambahkan');
        return redirect('/pesanan');
    }

    public function detail($id)
    {
        $produk = DB::table('penerimaan_pesanan')->where('id_pesanan', '=', $id)
        ->first();
        
        $detail = DB::table('detail_pesanan')->where('id_pesanan', '=', $id)
        ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id_produk')
        ->get();
       
        return view::make('admin.pesanan.detail')->with('produk', $produk)->with( 'detail', $detail);
    }
}
