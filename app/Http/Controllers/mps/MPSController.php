<?php

namespace App\Http\Controllers\mps;

use App\Http\Controllers\Controller;
use App\mps;
use App\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MPSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mps = DB::table('mps')
            ->join('produk', 'mps.id_produk', '=', 'produk.id_produk')
            ->orderBy('id_mps')
            ->paginate(10);

        return view('admin.mps.index', compact('mps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $iddetailpemesanan = DB::table('detail_mps')->pluck('id_detail_pesanan');

        if (session()->has('mps')) {
            $mps = session('mps');
        } else {
            $mps = [];
        }
        if ($request->has('bulan') && $request->has('nama_produk')) {
            $bulan = $request->get('bulan');
            session(['mps_bulan' => $bulan]);
            $bulan = date('m', strtotime($bulan));
            if ($iddetailpemesanan->isEmpty()) {
                $pemesanan = DB::table('detail_pesanan')
                    ->select('detail_pesanan.id_detail_pesanan', 'nama_produk', 'produk.id_produk', 'jumlah_pesanan', 'jadwal_produksi')
                    ->where('produk.id_produk', $request->get('nama_produk'))
                    ->join('penerimaan_pesanan', 'detail_pesanan.id_pesanan', '=', 'penerimaan_pesanan.id_pesanan')

                    ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id_produk')
                    ->whereMonth('jadwal_produksi', $bulan)
                    ->orderBy('jadwal_produksi')
                    ->get();
            } else {
                $iddetailpemesanan = $iddetailpemesanan->toArray();
                $pemesanan = DB::table('detail_pesanan')
                    ->select('detail_pesanan.id_detail_pesanan', 'nama_produk', 'produk.id_produk', 'jumlah_pesanan', 'jadwal_produksi')
                    ->where('produk.id_produk', $request->get('nama_produk'))
                    ->join('penerimaan_pesanan', 'detail_pesanan.id_pesanan', '=', 'penerimaan_pesanan.id_pesanan')
                    ->whereNotIn('id_detail_pesanan', $iddetailpemesanan)
                    ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id_produk')
                    ->whereMonth('jadwal_produksi', $bulan)
                    ->distinct()
                    ->get();
            }

            session(['pemesanan' => $pemesanan]);
        } else {
            $pemesanan = null;
        }

        if (!$iddetailpemesanan) {
            $produk = DB::table('detail_pesanan')
                ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id_produk')
                ->select('detail_pesanan.id_detail_pesanan', 'nama_produk', 'produk.id_produk')
                ->get();
        } else {
            $produk = DB::table('detail_pesanan')
                ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id_produk')
                ->select('detail_pesanan.id_detail_pesanan', 'nama_produk', 'produk.id_produk')
                ->whereNotIn('id_detail_pesanan', $iddetailpemesanan)
                ->get();
        }

        $produk2 = DB::table('produk')->get();
        $pesanan = DB::table('penerimaan_pesanan')->get();
        $pesanan2 = DB::table('penerimaan_pesanan')->get();
        $kode = mps::kode();

        return view('admin.mps.tambah', ['pemesanan' => $pemesanan, 'kode' => $kode, 'pesanan' => $pesanan, 'pesanan2' => $pesanan2, 'produk' => $produk, 'produk2' => $produk2, 'mps' => $mps]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datamps = session('pemesanan');
        // dd($datamps);
        $namaproduk = $datamps[0]->id_produk;
        $minggu1 = 0;
        $minggu2 = 0;
        $minggu3 = 0;
        $minggu4 = 0;
        foreach ($datamps as $dtmp) {
            $tanggal = date('d', strtotime($dtmp->jadwal_produksi));
            if ($tanggal >= 1 && $tanggal <= 7) {
                $minggu1 = $minggu1 + $dtmp->jumlah_pesanan;
            } elseif ($tanggal >= 8 && $tanggal <= 14) {
                $minggu2 = $minggu2 + $dtmp->jumlah_pesanan;
            } elseif ($tanggal >= 15 && $tanggal <= 21) {
                $minggu3 = $minggu3 + $dtmp->jumlah_pesanan;
            } elseif ($tanggal >= 22 && $tanggal <= 31) {
                $minggu4 = $minggu4 + $dtmp->jumlah_pesanan;
            }
        }
        $bulan = date('Y-m-d', strtotime(session('mps_bulan')));
        $mps = new mps();
        $mps->id_mps = $mps->kode();
        $mps->id_produk = $namaproduk;
        $mps->minggu_1 = $minggu1;
        $mps->minggu_2 = $minggu2;
        $mps->minggu_3 = $minggu3;
        $mps->minggu_4 = $minggu4;
        $mps->bulan = $bulan;
        $mps->save();

        foreach ($datamps as $dtmp) {
            DB::table('detail_mps')->insert([
                'id_mps' => $mps->id_mps,
                'id_detail_pesanan' => $dtmp->id_detail_pesanan,
                'jadwal_detail_produksi' => $dtmp->jadwal_produksi,
            ]);
        }  
        session()->forget('pemesanan');
        session()->flash('success', 'Data Master Production Schedule Berhasil Di Tambahkan');
        return redirect('/mps');
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

    public function hapus_session()
    {
        session()->forget('pemesanan');
        return redirect('/mps');
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
