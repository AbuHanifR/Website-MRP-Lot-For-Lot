@extends('admin.main')
@section('content')

    <div class="row">
        <div class="col-md-12">
            @if (session()->has('message'))
                <div class="alert alert-danger">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Laporan Perencanaan Kebutuhan Bahan Baku Perbulan</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="breadcrumb-link">Laporan Perencanaan Kebutuhan Bahan Baku
                                    Perbulan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Laporan Perencanaan Kebutuhan Bahan Baku
                                Perbulan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- ============================================================== -->
        <!-- basic table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="container">
                    <div class="row">
                        <h3 class="card-header m-4 text-left">Laporan Perencanaan Kebutuhan Bahan Baku Perbulan</h3>
                    </div>
                </div>

                <div class="card-body">
                    
                    <div class="row">
                        <h5 class=" mt-4 ml-3 text-left">Filter Bulan</h5>
                    </div>

                    <div class="ml-0 mr-2 mb-1" style="margin-top: -15px">
                        <form action="/laporan_perbulan" method="GET">
                            @csrf
                            <input type="hidden" name="status" class="status">
                            <input type="Month" name="filter" placeholder=" " value="{{ old('filter') }}">
                            <input type="submit" value="filter" class="btn btn-primary mb-1">
                            <input type="submit" nama="cetak" value="cetak" class="btn btn-success mb-1 cetak">
                        </form>
                    </div>

                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Bahan Baku</th>
                                    <th scope="col">Jumlah Bahan Baku</th>
                                    <th scope="col">Satuan</th>
                                    <th scope="col">Tanggal Perencanaan</th>
                                    <th scope="col">Minggu Di Butuhkan</th>
                                    <th scope="col">Minggu Di Pesan</th>
                                    <th scope="col">Keterangan</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporan as $no => $lpn)
                                <tr>
                                    <td>{{ $laporan->firstItem() + $no }}</td>
                                    <td>{{ $lpn->nama_bahan_baku }}</td>
                                     <td>{{ $lpn->jumlah_bahan * $lpn->jumlah_pesanan }}</td>
                                    <td>{{ $lpn->satuan }}</td>
                                    <td>{{ $lpn->jadwal_produksi }}</td>
                                    <td>
                                    @php
                                         $tanggal = date('d', strtotime($lpn->jadwal_produksi));
                                                if ($tanggal >= 1 && $tanggal <= 7) {
                                                    $hasil = 'minggu_1';
                                                } elseif ($tanggal >= 8 && $tanggal <= 14) {
                                                    $hasil = 'minggu_2';
                                                } elseif ($tanggal >= 15 && $tanggal <= 21) {
                                                    $hasil = 'minggu_3';
                                                } elseif ($tanggal >= 22 && $tanggal <= 31) {
                                                    $hasil = 'minggu_4';
                                                }
                                    @endphp
                                    {{$hasil}}
                                    </td>
                                    <td>
                                    @php
                                         $tanggal_dibutuhkan = date('d', strtotime($lpn->jadwal_produksi));
                                                if ($tanggal_dibutuhkan >= 1 && $tanggal_dibutuhkan <= 7) {
                                                    $hasil_dibutuhkan = 'minggu_0';
                                                } elseif ($tanggal_dibutuhkan >= 8 && $tanggal_dibutuhkan <= 14) {
                                                    $hasil_dibutuhkan = 'minggu_1';
                                                } elseif ($tanggal_dibutuhkan >= 15 && $tanggal_dibutuhkan <= 21) {
                                                    $hasil_dibutuhkan = 'minggu_2';
                                                } elseif ($tanggal_dibutuhkan >= 22 && $tanggal_dibutuhkan <= 31) {
                                                    $hasil_dibutuhkan = 'minggu_3';
                                                }
                                    @endphp
                                    {{$hasil_dibutuhkan}}
                                    </td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <br>
                        <div>
                            Showing
                            {{ $laporan->firstItem() }}
                            of
                            {{ $laporan->lastItem() }}
                        </div>
                        <div class="pull-right">
                            {{ $laporan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('.cetak').on('mouseover',function(){
            $('.status').val('cetak')
        })
    })
</script>

@endsection