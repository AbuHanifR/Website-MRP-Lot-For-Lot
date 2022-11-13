<?php

namespace App\Http\Controllers\masterbb;

use App\bahan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class masterbahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bahan = DB::table('bahan_baku')->paginate(10);
        return view('admin.master_bahan_baku.index', compact('bahan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode = bahan::kode();
        return view('admin.master_bahan_baku.tambah', compact('kode'));
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
            'id_bahan_baku' => 'required',
            'nama_bahan_baku' => 'required|unique:bahan_baku',
            'satuan' => 'required',
            'stok' => 'required|numeric',

        ]);

        $bahan = new bahan;
        $bahan->id_bahan_baku = $request->id_bahan_baku;
        $bahan->nama_bahan_baku = $request->nama_bahan_baku;
        $bahan->satuan = $request->satuan;
        $bahan->stok = $request->stok;

        $bahan->save();
        session()->flash('success', 'Data Bahan Baku Berhasil Di Tambahkan');
        return redirect('/master_bahan_baku')->with('msg', 'Data Bahan Baku Berhasil di Tambahkan');
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
        $data = DB::table('bahan_baku')->where('id_bahan_baku', '=', $id)->first();
        return view::make('admin.master_bahan_baku.ubah')->with('bahan', $data);
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
        $this->validate($request, [
            'nama_bahan_baku' => 'required|unique:bahan_baku',
        ]);

        $data = bahan::where('id_bahan_baku', '=', $id)->first();
        $data->nama_bahan_baku = $request->get('nama_bahan_baku');
        $data->satuan = $request->get('satuan');
        $data->stok = $request->get('stok');
        $data->save();
        session()->flash('success', 'Data Bahan Baku Berhasil Di Ubah');
        return redirect('master_bahan_baku')->with('msg', 'Berhasil Mengubah Data Bahan Baku');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jumlah_bbm = DB::table('detail_bahan_baku_masuk')->where('id_bahan_baku', '=', $id)->count();
        $jumlah_bbk = DB::table('detail_bahan_baku_keluar')->where('id_bahan_baku', '=', $id)->count();
        if ($jumlah_bbk > 0 or $jumlah_bbm > 0) {
            return redirect('master_bahan_baku')->with('message', 'Data Tidak Bisa Di Hapus');
        } else {
            DB::table('bahan_baku')->where('id_bahan_baku', '=', $id)->delete();
            session()->flash('message', 'Data Bahan Baku Telah Dihapus');
            return redirect::to('/master_bahan_baku');
        }
    }
}
