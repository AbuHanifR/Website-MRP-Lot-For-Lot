<?php

namespace App\Http\Controllers\bom;

use App\bom;
use App\detailbom;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
class detailbomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $bahan = DB::table('bahan_baku')->get();

        

        $detail = DB::table('detail_bom')->where('id_detail_bom', '=', $id)
        ->join('bahan_baku', 'detail_bom.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
        ->first();

        $data = DB::table('bom')->where('id_bom', '=', $detail->id_bom)
        ->join('produk', 'bom.id_produk', '=', 'produk.id_produk')
        ->first();
        return view::make('admin.bom.detailubah')->with( 'detail', $detail)->with( 'bahan', $bahan)->with( 'data', $data);

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
            'jumlah_bahan' => 'required|numeric'
        ]);

        $data = detailbom::where('id_detail_bom', '=', $id)->first();
        $data->jumlah_bahan = $request->get('jumlah_bahan');
        $data->save();
        session()->flash('success', 'Data Bill Of Material Berhasil Di Ubah');
        return redirect('bom')->with('msg', 'Berhasil Mengubah Data BOM');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('detail_bom')->where('id_detail_bom','=',$id)->delete();
        session()->flash('message', 'Data BOM Telah Dihapus');
        return redirect::to('/bom');
    }
}
