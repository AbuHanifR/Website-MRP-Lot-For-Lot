<?php

namespace App\Http\Controllers\produk;

use App\Http\Controllers\Controller;
use App\produk;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = DB::table('produk')->paginate(10);
        return view('admin.master_produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode = produk::kode(); 
    	return view('admin.master_produk.tambah', compact('kode'));
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
            'id_produk' => 'required',
            'nama_produk' => 'required|unique:produk'
        ]);

        $produk = new produk;
        $produk->id_produk = $request->id_produk;
        $produk->nama_produk = $request->nama_produk;
        $produk->save();
        session()->flash('success', 'Data Produk Berhasil Di Tambahkan');
        return redirect('/master_produk')->with('msg', 'Data Produk Berhasil di Tambahkan');
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
        $data = DB::table('produk')->where('id_produk', '=', $id)->first();
        return view::make('admin.master_produk.ubah')->with('produk', $data);
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
            'nama_produk' => 'required|unique:produk'
        ]);

        $data = produk::where('id_produk', '=', $id)->first();
        $data->nama_produk = $request->get('nama_produk');
        $data->save();
        session()->flash('success', 'Data Produk Berhasil Di Ubah');
        return redirect('master_produk')->with('msg', 'Berhasil Mengubah Data Produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('produk')->where('id_produk','=',$id)->delete();
        // session()->flash('message', 'Data Produk Telah Dihapus');
        return redirect::to('/master_produk')->with('message', 'Data Produk Telah Dihapus');
    }
}
