<?php

namespace App\Http\Controllers\bom;

use App\bom;
use App\detailbom;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class BomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bom = DB::table('bom')
            ->join('produk', 'bom.id_produk', '=', 'produk.id_produk')
            ->paginate(10);
            
        return view('admin.bom.index', compact('bom'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session()->has('bom')) {
            $bom = session('bom');
        } else {
            $bom = [];
        }
        // $produk = DB::table('produk')->get();
        $produk2 = DB::table('produk')->get();
        $produk = DB::table('produk')->whereNotExists(function($query){
            $query->select(DB::raw(1))
            ->from('bom')
            ->whereRaw('produk.id_produk = bom.id_produk');
        })
        ->get();
        $bahan = DB::table('bahan_baku')->get();
        $bahan2 = DB::table('bahan_baku')->get();
        $kode = bom::kode();

        return view('admin.bom.tambah', ['kode'=>$kode, 'bahan'=>$bahan, 'bahan2'=>$bahan2,'produk'=>$produk, 'produk2'=>$produk2,'bom'=>$bom]);
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
            'id_bom' => 'required',
            'nama_produk' => 'required|unique:produk',
            'nama_bahan_baku' => 'required',
            'jumlah_bahan' => 'required|numeric',
        ]);

        $bom = [];
        if (!session()->has('bom')) {

            $tampung = [
                'id_bom' => $request->get('id_bom'),
                'nama_produk' => $request->get('nama_produk'),
                'nama_bahan_baku' => $request->get('nama_bahan_baku'),
                'jumlah_bahan' => $request->get('jumlah_bahan'),
            ];
            array_push($bom, $tampung);

            session(['bom' => $bom]);
        } else {
            $databom = session('bom');
            $cek = array_search($request->get('nama_produk'),array_column($databom,'nama_produk'));
            if($cek >=0 ){
                // return redirect('/bom/create')->with('message', 'Data Bill Of Material Sudah Ada');
            }
            foreach ($databom as $dtb) {
                array_push($bom, $dtb);
            }
            $tampung = [
                'id_bom' => $request->get('id_bom'),
                'nama_produk' => $request->get('nama_produk'),
                'nama_bahan_baku' => $request->get('nama_bahan_baku'),
                'jumlah_bahan' => $request->get('jumlah_bahan'),
            ];
            array_push($bom, $tampung);

            session(['bom' => $bom]);
        }
        return redirect('/bom/create')->with('msg', 'Data Bill Of Material Berhasil di Tambahkan');
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
        $data = DB::table('bom')->where('id_bom', '=', $id)
        ->join('produk', 'bom.id_produk', '=', 'produk.id_produk')
        ->first();
        
        $detail = DB::table('detail_bom')->where('id_bom', '=', $id)
        ->join('bahan_baku', 'detail_bom.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
        ->get();
        return view::make('admin.bom.ubah')->with('bom', $data)->with( 'detail', $detail);
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
        // DB::table('bom')->where('id_bom','=',$id)->delete();
        // session()->flash('message', 'Data Bill Of Material Telah Dihapus');
        // return redirect::to('/bom');

        $bom = DB::table('bom')->where('id_bom', '=', $id)->first();
        $jumlah_bom1 = DB::table('detail_pesanan')->where('id_produk', '=', $bom->id_produk)->count();
       
        if ($jumlah_bom1 > 0 ) {
            return redirect('bom')->with('message', 'Data BOM Tidak Bisa Di Hapus');
        } else {
            DB::table('bom')->where('id_bom', '=', $id)->delete();
            session()->flash('message', 'Data BOM Telah Dihapus');
            return redirect::to('/bom');
        }
    }

    public function hapusdata($id)
    {
        $databom = session('bom');
        $hps = [];
        foreach ($databom as $dtb) {
            if ($dtb['nama_produk'] == $id) {
                unset($dtb);
            } elseif ($dtb['nama_bahan_baku'] == $id) {
                unset($dtb);
            } else {
                array_push($hps, $dtb);
            }
        }
        session(['bom' => $hps]);
        return redirect('/bom/create');
    }

    public function simpandata(Request $request)
    {
        $databom = session('bom');
        $totalbahan = array_sum(array_column($databom,'jumlah_bahan'));
        $namaproduk = $databom[0]['nama_produk'];
        $bom = new bom();
        $bom->id_bom=$bom->kode();
        $bom->id_produk=$namaproduk;
        $bom->gambar_bom = $request->file('gambar_bom')->store('gambar-bom');
        $bom->total_bahan=$totalbahan;
        $bom->save();
        
                foreach ($databom as $dtb) {
                    DB::table('detail_bom')->insert([
                        'id_bom' => $dtb['id_bom'],
                        'id_bahan_baku' => $dtb['nama_bahan_baku'],
                        'jumlah_bahan' => $dtb['jumlah_bahan'],
                    ]);
                }  
        session()->forget('bom');
        session()->flash('success', 'Data Bill Of Material Berhasil Di Tambahkan');
        return redirect('/bom');
    }

    public function detail($id)
    {
        $data = DB::table('bom')->where('id_bom', '=', $id)
        ->join('produk', 'bom.id_produk', '=', 'produk.id_produk')
        ->first();
        
        $detail = DB::table('detail_bom')->where('id_bom', '=', $id)
        ->join('bahan_baku', 'detail_bom.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
        ->get();
        return view::make('admin.bom.detail')->with('bom', $data)->with( 'detail', $detail);
    }

    
}
