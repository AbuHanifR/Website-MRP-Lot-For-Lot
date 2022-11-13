<?php

namespace App\Http\Controllers\mrp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\mrp;
use App\detailmrp;
use Illuminate\Support\Carbon;
use phpDocumentor\Reflection\PseudoTypes\True_;

class MRPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Menampilkan MPS
        $mps = DB::table('mps')
            ->get();

        //Menampilkan Produk
        $produk = DB::table('produk')
            ->get();
        detailmrp::query()->delete();
        foreach ($produk as $data) {
            // Mengecek data produk yang ada di tabel mrp
            $cek = DB::table('mrp')->where('id_produk', $data->id_produk)
                ->first();
            // Mengecek data produk yang ada di tabel mps
            $mps = DB::table('mps')->where('id_produk', $data->id_produk)
                ->get();
            $ar = [];
            if ($cek) {
                // Looping MPS
                foreach ($mps as $mp) {
                        // Mengecek data produk yang ada di tabel bom menggunakan data produk yang ada di tabel mps
                        $bom = DB::table('bom')->where('id_produk', $mp->id_produk)
                            ->join('detail_bom', 'bom.id_bom', '=', 'detail_bom.id_bom')
                            ->get();
                        
                        if ($bom->isNotEmpty()) {
                            foreach ($bom as $bm) {
                                // Mengecek data bahan baku dan detail bom dari tabel bom, mengecek data mps dari tabel mps didalam tabel detail_mps
                                $detailmps = DB::table('detail_mps')
                                    // detailpesanan, detailbom, bom
                                    ->join('detail_pesanan', 'detail_mps.id_detail_pesanan', '=', 'detail_pesanan.id_detail_pesanan')
                                    ->join('bom', 'detail_pesanan.id_produk', '=', 'bom.id_produk')
                                    ->join('detail_bom', 'bom.id_bom', '=', 'detail_bom.id_bom')
                                    // mengecek data bahan baku dari tabel bom
                                    ->where('id_bahan_baku', $bm->id_bahan_baku)
                                    // mengecek data detail bom dari tabel bom
                                    ->where('id_detail_bom', $bm->id_detail_bom)
                                    // mengecek data mps dari tabel mps
                                    ->where('id_mps', $mp->id_mps)
                                    ->orderBy('jadwal_detail_produksi')
                                    ->get();

                                // dd($detailmps);
                                if ($detailmps->isNotEmpty()) {
                                    foreach ($detailmps as $dms) {
                                        // mengecek detail mrp yang ada pada tabel mrp
                                        $cekdetailmrp = DB::table('detail_mrp')->where('id_mrp', $cek->id_mrp)
                                            ->where('id_mps', $dms->id_mps)
                                            ->where('id_detail_bom', $bm->id_detail_bom)
                                            ->first();
                                        $bahanbaku = DB::table('bahan_baku')->where('id_bahan_baku', $bm->id_bahan_baku)
                                            ->first();
                                        $tanggalproduksi = $dms->jadwal_detail_produksi;
                                        $bulan = date('m', strtotime($tanggalproduksi));
                                        $mpsbulan = date('m', strtotime($mp->bulan));
                                        $converttanggal = date('Y-m-d', strtotime($tanggalproduksi));
                                        $tanggalpemesanan = date('Y-m-d', strtotime($converttanggal . '-1 week'));
                                        $cekmrptanggal = DB::table('detail_mrp')->where('id_mrp', $cek->id_mrp)
                                            ->join('detail_bom', 'detail_mrp.id_detail_bom', '=', 'detail_bom.id_detail_bom')
                                            ->where('id_bahan_baku', $bm->id_bahan_baku)
                                            ->orderBy('bulan_mrp', 'desc')
                                            // ->whereDate('bulan_mrp', '<', $tanggalproduksi)
                                            ->whereMonth('bulan_mrp', $bulan)
                                            ->first();
                                        $cekohi = detailmrp::where('id_mrp', $cek->id_mrp)
                                            ->join('detail_bom', 'detail_mrp.id_detail_bom', '=', 'detail_bom.id_detail_bom')
                                            ->where('id_bahan_baku', $bm->id_bahan_baku)
                                            ->oldest('bulan_mrp')
                                            ->first();

                                        if ($cekohi) {
                                            $cekohi->OHI = $bahanbaku->stok;
                                            if ($bahanbaku->stok > $cekohi->PORel) {
                                                $cekohi->PORel = 0;
                                            }
                                            $cekohi->save();
                                        }
                                        if($bulan==$mpsbulan){
                                            if ($cekdetailmrp) {
                                                $gr = $dms->jumlah_pesanan * $dms->jumlah_bahan;
                                                $newmp = new detailmrp();
                                                $newmp->bulan_mrp = $tanggalproduksi;
                                                $newmp->GR = $gr;
                                                $newmp->SR = 0;
                                                $newmp->OHI = 0;
                                                $newmp->NR = $gr;
                                                $newmp->POR = $gr;
                                                $newmp->PORel = 0;
                                                $newmp->id_detail_bom = $bm->id_detail_bom;
                                                $newmp->id_mps = $mp->id_mps;
                                                $newmp->id_mrp = $cek->id_mrp;
                                                $newmp->save();
                                            } else {
    
                                                // dd($cekmrptanggal);
                                                $gr = $dms->jumlah_pesanan * $dms->jumlah_bahan;
                                                if ($cekmrptanggal) {
                                                    $updatemrp = detailmrp::findorfail($cekmrptanggal->id_detail_mrp);
                                                    $updatemrp->PORel = $gr;
                                                    $updatemrp->save();
                                                }
    
                                                if ($gr >= 0) {
                                                    if (!$cekmrptanggal) {
                                                        $new = new detailmrp();
                                                        $new->bulan_mrp = $tanggalpemesanan;
                                                        $new->GR = 0;
                                                        $new->SR = 0;
                                                        $new->OHI = 0;
                                                        $new->NR = 0;
                                                        $new->POR = 0;
                                                        $new->PORel = $gr;
                                                        $new->id_detail_bom = $bm->id_detail_bom;
                                                        $new->id_mps = $mp->id_mps;
                                                        $new->id_mrp = $cek->id_mrp;
                                                        array_push($ar, $new);
                                                        $new->save();
                                                    }
                                                    $newmp = new detailmrp();
                                                    $newmp->bulan_mrp = $tanggalproduksi;
                                                    $newmp->GR = $gr;
                                                    $newmp->SR = 0;
                                                    $newmp->OHI = 0;
                                                    $newmp->NR = $gr;
                                                    $newmp->POR = $gr;
                                                    $newmp->PORel = 0;
                                                    $newmp->id_detail_bom = $bm->id_detail_bom;
                                                    $newmp->id_mps = $mp->id_mps;
                                                    $newmp->id_mrp = $cek->id_mrp;
                                                    $newmp->save();
                                                    array_push($ar, $newmp);
    
    
    
    
                                                    // dd($new);
                                                }
                                            }
                                        }else{
                                            if ($cekdetailmrp) {
                                                $gr = $dms->jumlah_pesanan * $dms->jumlah_bahan;
                                                $newmp = new detailmrp();
                                                $newmp->bulan_mrp = $tanggalproduksi;
                                                $newmp->GR = $gr;
                                                $newmp->SR = 0;
                                                $newmp->OHI = 0;
                                                $newmp->NR = $gr;
                                                $newmp->POR = $gr;
                                                $newmp->PORel = 0;
                                                $newmp->id_detail_bom = $bm->id_detail_bom;
                                                $newmp->id_mps = $mp->id_mps;
                                                $newmp->id_mrp = $cek->id_mrp;
                                                $newmp->save();
                                            } else {
    
                                                // dd($cekmrptanggal);
                                                $gr = $dms->jumlah_pesanan * $dms->jumlah_bahan;
                                                if ($cekmrptanggal) {
                                                    $updatemrp = detailmrp::findorfail($cekmrptanggal->id_detail_mrp);
                                                    $updatemrp->PORel = $gr;
                                                    $updatemrp->save();
                                                }
    
                                                if ($gr >= 0) {
                                                    if (!$cekmrptanggal) {
                                                        $new = new detailmrp();
                                                        $new->bulan_mrp = $tanggalpemesanan;
                                                        $new->GR = 0;
                                                        $new->SR = 0;
                                                        $new->OHI = 0;
                                                        $new->NR = 0;
                                                        $new->POR = 0;
                                                        $new->PORel = $gr;
                                                        $new->id_detail_bom = $bm->id_detail_bom;
                                                        $new->id_mps = $mp->id_mps;
                                                        $new->id_mrp = $cek->id_mrp;
                                                        array_push($ar, $new);
                                                        $new->save();
                                                    }
                                                    $newmp = new detailmrp();
                                                    $newmp->bulan_mrp = $tanggalproduksi;
                                                    $newmp->GR = $gr;
                                                    $newmp->SR = 0;
                                                    $newmp->OHI = 0;
                                                    $newmp->NR = $gr;
                                                    $newmp->POR = $gr;
                                                    $newmp->PORel = 0;
                                                    $newmp->id_detail_bom = $bm->id_detail_bom;
                                                    $newmp->id_mps = $mp->id_mps;
                                                    $newmp->id_mrp = $cek->id_mrp;
                                                    $newmp->save();
                                                    array_push($ar, $newmp);
    
    
    
    
                                                    // dd($new);
                                                }
                                            }
                                            // dd($mp);
                                        }
                                       
                                    }
                                }
                            }
                            // $newmp=new detailmrp();
                            // $newmp->bulan_mrp=$mp->bulan;
                            // $newmp->GR=0;
                            // $newmp->SR=0;
                            // $newmp->OHI=0;
                            // $newmp->NR=0;
                            // $newmp->POR=0;
                            // $newmp->PORel=0;
                            // $newmp->id_bom=$bom->id_bom;
                            // $newmp->id_mps=$mp->id_mps;
                            // $newmp->id_mrp=$newmrp->id_mrp;
                            // $newmp->save();
                        }
                    
                }
                // dd($ar);
            } else {
                $newmrp = new mrp();
                $newmrp->id_produk = $data->id_produk;
                $newmrp->id_mrp = $newmrp->kode();
                $newmrp->save();
                foreach ($mps as $mp) {
                    $cekmp = DB::table('detail_mrp')->where('id_mrp', $newmrp->id_mrp)
                        ->first();
                    if ($cekmp) {
                        $updatemp = detailmrp::find($cekmp->id_detail_mrp);
                        $updatemp->bulan_mrp = $mp->bulan;
                        $updatemp->GR = 0;
                        $updatemp->SR = 0;
                        $updatemp->OHI = 0;
                        $updatemp->NR = 0;
                        $updatemp->POR = 0;
                        $updatemp->PORel = 0;
                        $updatemp->save();
                    } else {
                        $bom = DB::table('bom')->where('id_produk', $mp->id_produk)
                            ->join('detail_bom', 'bom.id_bom', '=', 'detail_bom.id_bom')
                            ->get();

                        if ($bom->isNotEmpty()) {
                            foreach ($bom as $bm) {
                                $detailmps = DB::table('detail_mps')
                                    // detailpesanan, detailbom, bom
                                    ->join('detail_pesanan', 'detail_mps.id_detail_pesanan', '=', 'detail_pesanan.id_detail_pesanan')
                                    ->join('detail_bom', 'detail_mps.id_detail_bom', '=', 'detail_bom.id_detail_bom')
                                    ->join('bom', 'detail_bom.id_bom', '=', 'bom.id_bom')
                                    ->where('id_bahan_baku', $bm->id_bahan_baku)
                                    ->first();
                                dd($detailmps);
                            }
                            $newmp = new detailmrp();
                            $newmp->bulan_mrp = $mp->bulan;
                            $newmp->GR = 0;
                            $newmp->SR = 0;
                            $newmp->OHI = 0;
                            $newmp->NR = 0;
                            $newmp->POR = 0;
                            $newmp->PORel = 0;
                            $newmp->id_bom = $bom->id_bom;
                            $newmp->id_mps = $mp->id_mps;
                            $newmp->id_mrp = $newmrp->id_mrp;
                            $newmp->save();
                        }
                    }
                }
            }
        }
        $mrp = DB::table('mrp')
            ->join('produk', 'mrp.id_produk', '=', 'produk.id_produk')
            ->paginate(5);
        // dd($produk);
        return view('admin.mrp.index', compact('mrp', 'mps'));
    }

    public function hitung( Request $request)
    {
        // dd($request->all());
        $month = date('m', strtotime($request->get('bulan')));
        if ($request->has('bulan')) {
            $id=$request->get('nama_produk');
            $bulan = date('m', strtotime($request->get('bulan')));
            $mrp = DB::table('mrp')
                ->join('produk', 'mrp.id_produk', '=', 'produk.id_produk')
                ->where('id_mrp', $id)->first();
            $produk = DB::table('produk')
                ->select('produk.id_produk','nama_produk','mrp.id_mrp','bulan_mrp', 
                'minggu_1', 'minggu_2', 'minggu_3', 'minggu_4')
                ->join('mrp', 'produk.id_produk', '=', 'mrp.id_produk')
                ->join('detail_mrp', 'mrp.id_mrp', '=', 'detail_mrp.id_mrp')
                // ->join('mps', 'produk.id_produk', '=', 'mps.id_produk')
                ->join('mps', 'detail_mrp.id_mps', '=', 'mps.id_mps')
                ->whereMonth('bulan_mrp', $bulan)
                ->where('mrp.id_mrp', $id)

                ->where('produk.id_produk', $mrp->id_produk)
                ->distinct()->get();

                $produk1 = DB::table('produk')
                ->select('produk.id_produk','nama_produk','mrp.id_mrp','bulan_mrp', 
                'minggu_1', 'minggu_2', 'minggu_3', 'minggu_4')
                ->join('mrp', 'produk.id_produk', '=', 'mrp.id_produk')
                ->join('detail_mrp', 'mrp.id_mrp', '=', 'detail_mrp.id_mrp')
                // ->join('mps', 'produk.id_produk', '=', 'mps.id_produk')
                ->join('mps', 'detail_mrp.id_mps', '=', 'mps.id_mps')
                ->whereMonth('bulan_mrp', $bulan)
                ->where('mrp.id_mrp', $id)

                ->where('produk.id_produk', $mrp->id_produk)
                ->distinct()->first();

                $ar2=[];
                // dd($produk);
                if($produk1){
                    $x['nama_produk']=$produk1->nama_produk;
                    $x['GR']=0;
                    $x['SR']=0;
                    $x['OHI']=0;
                    $x['NR']=0;
                    $x['POR']=0;
                    $x['PORel']=$produk1->minggu_1;
                    $x['bulan_mrp']=0;
                    array_push($ar2,$x);
                }
               
            $no=0;
            foreach($produk as $key=>$prd){
                if($this->cekminggu($prd->bulan_mrp)=='minggu_1'){
                    $hasil=$prd->minggu_1;
                    $porel=$prd->minggu_2;
                }
                if($this->cekminggu($prd->bulan_mrp)=='minggu_2'){
                    $hasil=$prd->minggu_2;
                    $porel=$prd->minggu_3;
                }
                if($this->cekminggu($prd->bulan_mrp)=='minggu_3'){
                    $hasil=$prd->minggu_3;
                    $porel=$prd->minggu_4;
                }
                if($this->cekminggu($prd->bulan_mrp)=='minggu_4'){
                    $hasil=$prd->minggu_4;
                    $porel=0;
                }
                $no = $key+1;
                

                $x['nama_produk']=$prd->nama_produk;
                $x['GR']=$hasil;
                $x['SR']=0;
                $x['OHI']=0;
                $x['NR']=$hasil;
                $x['POR']=$hasil;
                $x['PORel']=$porel;
                $x['bulan_mrp']=$prd->bulan_mrp;
                if(isset($produk[$no])){
                    if($this->cekmingguStatus($produk[$no]->bulan_mrp,$prd->bulan_mrp)){
                        array_push($ar2,$x);
                    }
                }else{
                    array_push($ar2,$x);
                }
               
            }
                

            $mps = DB::table('mps')
                ->join('produk', 'mps.id_produk', '=', 'produk.id_produk')
                ->whereMonth('bulan', $bulan)->where('mps.id_produk', $mrp->id_produk)->get();

            $detailbahanbaku = DB::table('bahan_baku')
                ->get();
            $ar = [];
            foreach ($detailbahanbaku as $dtb) {
                $detailmrp = DB::table('mps')
                    //detail mrp bom bahan
                    // ->join('produk', 'mps.id_produk', '=', 'produk.id_produk')
                    ->join('detail_mrp', 'detail_mrp.id_mps', '=', 'mps.id_mps')
                    ->join('detail_bom', 'detail_mrp.id_detail_bom', '=', 'detail_bom.id_detail_bom')
                    ->join('bahan_baku', 'detail_bom.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
                    ->whereMonth('bulan', $bulan)->where('mps.id_produk', $mrp->id_produk)
                    ->where('bahan_baku.id_bahan_baku', $dtb->id_bahan_baku)
                    ->orderBy('bulan_mrp')
                    ->get();
                if ($detailmrp->isNotEmpty()) {

                    $stok = $dtb->stok;
                    foreach ($detailmrp as $dmp) {
                        $cekdetail = detailmrp::where('id_detail_mrp', $dmp->id_detail_mrp)
                            // ->whereMonth('bulan_mrp', $bulan)
                            ->first();
                        $idsebelum = $dmp->id_detail_mrp - 1;
                        $ceksebelum = detailmrp::where('id_detail_bom', $dmp->id_detail_bom)
                            // ->whereMonth('bulan_mrp', $bulan)
                            ->where('id_detail_mrp', $idsebelum)
                            ->first();
                        if ($cekdetail) {
                            $id = $dmp->id_detail_mrp + 1;
                            // dd($cekdetail);
                            if ($cekdetail->GR <= $stok && $stok > 0) {
                                if ($ceksebelum) {
                                    if ($ceksebelum->OHI == 0) {
                                        $hasil = $cekdetail->GR;
                                        $cekdetail->OHI = 0;
                                        $cekdetail->NR = $hasil;
                                        $cekdetail->POR = $hasil;
                                        $cekdetail->save();
                                    } elseif ($cekdetail->GR >= $ceksebelum->OHI) {
                                        $hasil = $cekdetail->GR - $ceksebelum->OHI;

                                        $cekdetail->OHI = 0;
                                        $cekdetail->NR = $hasil;
                                        $cekdetail->POR = $hasil;
                                        if($ceksebelum->convert_bulan($ceksebelum->bulan_mrp)==$bulan){
                                            $ceksebelum->PORel = $hasil;
                                            // dd($ceksebelum);
                                        }else{
                                            $ceksebelum->PORel=0;
                                        }

                                        // dd($ceksebelum);
                                        $ceksebelum->save();
                                        $stok = $hasil;
                                        $cekdetail->save();
                                       
                                    } else {
                                        $hasil = $ceksebelum->OHI - $cekdetail->GR;

                                        $cekdetail->OHI = $hasil;
                                        $cekdetail->NR = 0;
                                        $cekdetail->POR = 0;
                                        $ceksebelum->PORel = 0;
                                        $ceksebelum->save();
                                        $stok = $hasil;
                                        $cekdetail->save();
                                    }
                                } else {
                                    $hasil = $stok - $cekdetail->GR;
                                    $cekdetail->OHI = $hasil;
                                    $cekdetail->NR = 0;
                                    $cekdetail->POR = 0;
                                    $stok = $hasil;
                                    $cekdetail->save();
                                }
                            } else {
                                if ($ceksebelum) {
                                    if ($ceksebelum->OHI == 0) {
                                        $hasil = $cekdetail->GR;
                                        $cekdetail->OHI = 0;
                                        $cekdetail->NR = $hasil;
                                        $cekdetail->POR = $hasil;
                                        $cekdetail->save();
                                        
                                    } elseif ($cekdetail->GR >= $ceksebelum->OHI) {
                                        $hasil = $cekdetail->GR - $ceksebelum->OHI;

                                        $cekdetail->OHI = 0;
                                        $cekdetail->NR = $hasil;
                                        $cekdetail->POR = $hasil;
                                        if($ceksebelum->convert_bulan($ceksebelum->bulan_mrp)==$bulan){
                                            $ceksebelum->PORel = $hasil;
                                        }else{
                                            $ceksebelum->PORel=0;
                                        }
                                       
                                        $ceksebelum->save();
                                        $stok = $hasil;
                                        $cekdetail->save();
                                       
                                    } else {
                                        $hasil = $ceksebelum->OHI - $cekdetail->GR;

                                        $cekdetail->OHI = $hasil;
                                        $cekdetail->NR = 0;
                                        $cekdetail->POR = 0;
                                        $ceksebelum->PORel = 0;
                                        $ceksebelum->save();
                                        $stok = $hasil;
                                        $cekdetail->save();
                                    }
                                } else {
                                    $hasil = $cekdetail->GR - $stok;
                                    $cekdetail->OHI = 0;
                                    $cekdetail->NR = $hasil;
                                    $cekdetail->POR = $hasil;
                                    $cekdetail->save();
                                }
                            }

                            // dd($cekdetail);
                        }
                    }
                    foreach ($detailmrp as $dmp) {
                        $cekdetail = detailmrp::where('id_detail_mrp', $dmp->id_detail_mrp)
                            // ->whereMonth('bulan_mrp', $bulan)
                            ->first();
                        if ($cekdetail) {
                            $id = $dmp->id_detail_mrp + 1;
                            $cekpemesanan = detailmrp::where('id_detail_mrp', $id)
                                // ->whereMonth('bulan_mrp', $bulan)
                                ->where('id_detail_bom', $cekdetail->id_detail_bom)->first();
                            if ($cekpemesanan) {
                                
                                if($cekpemesanan->convert_bulan($cekpemesanan->bulan_mrp)==$bulan){
                                    $cekdetail->PORel = $cekpemesanan->POR;
                                    // dd($cekdetail);
                                }else{
                                    $cekdetail->PORel = 0;
                                }
                                $cekdetail->save();
                            }


                            // dd($cekdetail);
                        }
                    }
                }
                $detailmrp = DB::table('mps')
                    //detail mrp bom bahan
                    // ->join('produk', 'mps.id_produk', '=', 'produk.id_produk')
                    ->join('detail_mrp', 'detail_mrp.id_mps', '=', 'mps.id_mps')
                    ->join('detail_bom', 'detail_mrp.id_detail_bom', '=', 'detail_bom.id_detail_bom')
                    ->join('bahan_baku', 'detail_bom.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
                    ->whereMonth('bulan', $bulan)->where('mps.id_produk', $mrp->id_produk)
                    ->where('bahan_baku.id_bahan_baku', $dtb->id_bahan_baku)
                    ->orderBy('bulan_mrp')
                    ->get();
                if ($detailmrp->isNotEmpty()) {
                    $x['nama_bahan_baku'] = $dtb->nama_bahan_baku;
                    $x['detail'] = $detailmrp;
                    array_push($ar, $x);
                }
            }

            $detailmrp = $ar;
            // dd($detailmrp);
        } else {

            $mrp = null;
            $mps = null;
            $detailmrp = null;
            $ar2= null;

        }
        $mrpselect = DB::table('mrp')
        ->join('produk', 'mrp.id_produk', '=', 'produk.id_produk')
        ->get();
        
        return view('admin.mrp.tambah2', compact('mrp', 'mrpselect', 'mps', 'id', 'detailmrp','month', 'ar2'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mps = DB::table('mps')
        ->get();
    $produk = DB::table('produk')
        ->get();
    detailmrp::query()->delete();
    foreach ($produk as $data) {
        $cek = DB::table('mrp')->where('id_produk', $data->id_produk)
            ->first();
        $mps = DB::table('mps')->where('id_produk', $data->id_produk)
            ->get();
        $ar = [];
        if ($cek) {
            foreach ($mps as $key=>$mp) {
                //  if($key>0){
                //     dd($mp);
                //  }
                    $bom = DB::table('bom')->where('id_produk', $mp->id_produk)
                        ->join('detail_bom', 'bom.id_bom', '=', 'detail_bom.id_bom')
                        ->get();
                    if ($bom->isNotEmpty()) {
                        // dd($bom);
                        foreach ($bom as $key1=>$bm) {
                            // if($key1>4){
                            //         dd($bm);
                            //      }
                            $detailmps = DB::table('detail_mps')
                                // detailpesanan, detailbom, bom
                                ->join('detail_pesanan', 'detail_mps.id_detail_pesanan', '=', 'detail_pesanan.id_detail_pesanan')
                                ->join('bom', 'detail_pesanan.id_produk', '=', 'bom.id_produk')
                                ->join('detail_bom', 'bom.id_bom', '=', 'detail_bom.id_bom')
                                ->where('id_bahan_baku', $bm->id_bahan_baku)
                                ->where('id_detail_bom', $bm->id_detail_bom)
                                ->where('id_mps', $mp->id_mps)
                                ->orderBy('jadwal_detail_produksi')
                                ->get();

                            // dd($detailmps);
                            if ($detailmps->isNotEmpty()) {
                                foreach ($detailmps as $dms) {
                                    $cekdetailmrp = DB::table('detail_mrp')->where('id_mrp', $cek->id_mrp)
                                        ->where('id_mps', $dms->id_mps)
                                        ->where('id_detail_bom', $bm->id_detail_bom)
                                        ->first();
                                    $bahanbaku = DB::table('bahan_baku')->where('id_bahan_baku', $bm->id_bahan_baku)
                                        ->first();
                                    $tanggalproduksi = $dms->jadwal_detail_produksi;
                                    $bulan = date('m', strtotime($tanggalproduksi));
                                    $mpsbulan = date('m', strtotime($mp->bulan));
                                    $converttanggal = date('Y-m-d', strtotime($tanggalproduksi));
                                    $tanggalpemesanan = date('Y-m-d', strtotime($converttanggal . '-1 week'));
                                    $cekmrptanggal = DB::table('detail_mrp')->where('id_mrp', $cek->id_mrp)
                                        ->join('detail_bom', 'detail_mrp.id_detail_bom', '=', 'detail_bom.id_detail_bom')
                                        ->where('id_bahan_baku', $bm->id_bahan_baku)
                                        ->orderBy('bulan_mrp', 'desc')
                                        // ->whereDate('bulan_mrp', '<', $tanggalproduksi)
                                        ->whereMonth('bulan_mrp', $bulan)
                                        ->first();
                                    $cekohi = detailmrp::where('id_mrp', $cek->id_mrp)
                                        ->join('detail_bom', 'detail_mrp.id_detail_bom', '=', 'detail_bom.id_detail_bom')
                                        ->where('id_bahan_baku', $bm->id_bahan_baku)
                                        ->oldest('bulan_mrp')
                                        ->first();

                                    if ($cekohi) {
                                        $cekohi->OHI = $bahanbaku->stok;
                                        if ($bahanbaku->stok > $cekohi->PORel) {
                                            $cekohi->PORel = 0;
                                        }
                                        $cekohi->save();
                                    }
                                    if($bulan==$mpsbulan){
                                        if ($cekdetailmrp) {
                                            $gr = $dms->jumlah_pesanan * $dms->jumlah_bahan;
                                            $newmp = new detailmrp();
                                            $newmp->bulan_mrp = $tanggalproduksi;
                                            $newmp->GR = $gr;
                                            $newmp->SR = 0;
                                            $newmp->OHI = 0;
                                            $newmp->NR = $gr;
                                            $newmp->POR = $gr;
                                            $newmp->PORel = 0;
                                            $newmp->id_detail_bom = $bm->id_detail_bom;
                                            $newmp->id_mps = $mp->id_mps;
                                            $newmp->id_mrp = $cek->id_mrp;
                                            $newmp->save();
                                        } else {

                                            // dd($cekmrptanggal);
                                            $gr = $dms->jumlah_pesanan * $dms->jumlah_bahan;
                                            if ($cekmrptanggal) {
                                                $updatemrp = detailmrp::findorfail($cekmrptanggal->id_detail_mrp);
                                                $updatemrp->PORel = $gr;
                                                $updatemrp->save();
                                            }

                                            if ($gr >= 0) {
                                                if (!$cekmrptanggal) {
                                                    $new = new detailmrp();
                                                    $new->bulan_mrp = $tanggalpemesanan;
                                                    $new->GR = 0;
                                                    $new->SR = 0;
                                                    $new->OHI = 0;
                                                    $new->NR = 0;
                                                    $new->POR = 0;
                                                    $new->PORel = $gr;
                                                    $new->id_detail_bom = $bm->id_detail_bom;
                                                    $new->id_mps = $mp->id_mps;
                                                    $new->id_mrp = $cek->id_mrp;
                                                    array_push($ar, $new);
                                                    $new->save();
                                                }
                                                $newmp = new detailmrp();
                                                $newmp->bulan_mrp = $tanggalproduksi;
                                                $newmp->GR = $gr;
                                                $newmp->SR = 0;
                                                $newmp->OHI = 0;
                                                $newmp->NR = $gr;
                                                $newmp->POR = $gr;
                                                $newmp->PORel = 0;
                                                $newmp->id_detail_bom = $bm->id_detail_bom;
                                                $newmp->id_mps = $mp->id_mps;
                                                $newmp->id_mrp = $cek->id_mrp;
                                                $newmp->save();
                                                array_push($ar, $newmp);




                                                // dd($new);
                                            }
                                        }
                                    }else{
                                        if ($cekdetailmrp) {
                                            $gr = $dms->jumlah_pesanan * $dms->jumlah_bahan;
                                            $newmp = new detailmrp();
                                            $newmp->bulan_mrp = $tanggalproduksi;
                                            $newmp->GR = $gr;
                                            $newmp->SR = 0;
                                            $newmp->OHI = 0;
                                            $newmp->NR = $gr;
                                            $newmp->POR = $gr;
                                            $newmp->PORel = 0;
                                            $newmp->id_detail_bom = $bm->id_detail_bom;
                                            $newmp->id_mps = $mp->id_mps;
                                            $newmp->id_mrp = $cek->id_mrp;
                                            $newmp->save();
                                        } else {

                                            // dd($cekmrptanggal);
                                            $gr = $dms->jumlah_pesanan * $dms->jumlah_bahan;
                                            if ($cekmrptanggal) {
                                                $updatemrp = detailmrp::findorfail($cekmrptanggal->id_detail_mrp);
                                                $updatemrp->PORel = $gr;
                                                $updatemrp->save();
                                            }

                                            if ($gr >= 0) {
                                                if (!$cekmrptanggal) {
                                                    $new = new detailmrp();
                                                    $new->bulan_mrp = $tanggalpemesanan;
                                                    $new->GR = 0;
                                                    $new->SR = 0;
                                                    $new->OHI = 0;
                                                    $new->NR = 0;
                                                    $new->POR = 0;
                                                    $new->PORel = $gr;
                                                    $new->id_detail_bom = $bm->id_detail_bom;
                                                    $new->id_mps = $mp->id_mps;
                                                    $new->id_mrp = $cek->id_mrp;
                                                    array_push($ar, $new);
                                                    $new->save();
                                                }
                                                $newmp = new detailmrp();
                                                $newmp->bulan_mrp = $tanggalproduksi;
                                                $newmp->GR = $gr;
                                                $newmp->SR = 0;
                                                $newmp->OHI = 0;
                                                $newmp->NR = $gr;
                                                $newmp->POR = $gr;
                                                $newmp->PORel = 0;
                                                $newmp->id_detail_bom = $bm->id_detail_bom;
                                                $newmp->id_mps = $mp->id_mps;
                                                $newmp->id_mrp = $cek->id_mrp;
                                                $newmp->save();
                                                array_push($ar, $newmp);




                                                // dd($new);
                                            }
                                        }
                                        // dd($mp);
                                    }
                                   
                                }
                            }
                        }
                        // $newmp=new detailmrp();
                        // $newmp->bulan_mrp=$mp->bulan;
                        // $newmp->GR=0;
                        // $newmp->SR=0;
                        // $newmp->OHI=0;
                        // $newmp->NR=0;
                        // $newmp->POR=0;
                        // $newmp->PORel=0;
                        // $newmp->id_bom=$bom->id_bom;
                        // $newmp->id_mps=$mp->id_mps;
                        // $newmp->id_mrp=$newmrp->id_mrp;
                        // $newmp->save();
                    }
                
            }
            // dd($ar);
        } else {
            $newmrp = new mrp();
            $newmrp->id_produk = $data->id_produk;
            $newmrp->id_mrp = $newmrp->kode();
            $newmrp->save();
            foreach ($mps as $mp) {
                $cekmp = DB::table('detail_mrp')->where('id_mrp', $newmrp->id_mrp)
                    ->first();
                if ($cekmp) {
                    $updatemp = detailmrp::find($cekmp->id_detail_mrp);
                    $updatemp->bulan_mrp = $mp->bulan;
                    $updatemp->GR = 0;
                    $updatemp->SR = 0;
                    $updatemp->OHI = 0;
                    $updatemp->NR = 0;
                    $updatemp->POR = 0;
                    $updatemp->PORel = 0;
                    $updatemp->save();
                } else {
                    $bom = DB::table('bom')->where('id_produk', $mp->id_produk)
                        ->join('detail_bom', 'bom.id_bom', '=', 'detail_bom.id_bom')
                        ->get();

                    if ($bom->isNotEmpty()) {
                        foreach ($bom as $bm) {
                            $detailmps = DB::table('detail_mps')
                                // detailpesanan, detailbom, bom
                                ->join('detail_pesanan', 'detail_mps.id_detail_pesanan', '=', 'detail_pesanan.id_detail_pesanan')
                                ->join('detail_bom', 'detail_mps.id_detail_bom', '=', 'detail_bom.id_detail_bom')
                                ->join('bom', 'detail_bom.id_bom', '=', 'bom.id_bom')
                                ->where('id_bahan_baku', $bm->id_bahan_baku)
                                ->first();
                            dd($detailmps);
                        }
                        $newmp = new detailmrp();
                        $newmp->bulan_mrp = $mp->bulan;
                        $newmp->GR = 0;
                        $newmp->SR = 0;
                        $newmp->OHI = 0;
                        $newmp->NR = 0;
                        $newmp->POR = 0;
                        $newmp->PORel = 0;
                        $newmp->id_bom = $bom->id_bom;
                        $newmp->id_mps = $mp->id_mps;
                        $newmp->id_mrp = $newmrp->id_mrp;
                        $newmp->save();
                    }
                }
            }
        }
    }
    $mrpselect = DB::table('mrp')
        ->join('produk', 'mrp.id_produk', '=', 'produk.id_produk')
        ->get();
        $mps = null;
        $detailmrp = null;
    return view('admin.mrp.tambah2', compact('mrpselect', 'mps', 'detailmrp'));
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

    public function cekminggu($tanggal)
    {
        $tanggal = date('d', strtotime($tanggal));
        if ($tanggal >= 1 && $tanggal <= 7) {
            $hasil = 'minggu_1';
        } elseif ($tanggal >= 8 && $tanggal <= 14) {
            $hasil = 'minggu_2';
        } elseif ($tanggal >= 15 && $tanggal <= 21) {
            $hasil = 'minggu_3';
        } elseif ($tanggal >= 22 && $tanggal <= 31) {
            $hasil = 'minggu_4';
        }
        return $hasil;
    }

    public function cekmingguStatus($tanggal1, $tanggal2)
    {
        $cek1 = Carbon::parse($tanggal1);
        $cek2 = Carbon::parse($tanggal2);
        $beda = $cek1->diffInDays($cek2);
        if($beda<=8){
            return true;

        }else{
            return false;
        }
    }

    
}
