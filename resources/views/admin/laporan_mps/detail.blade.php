@extends('admin.main')
@section('content')

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Laporan Master Production Schedule</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="breadcrumb-link">Laporan Master Production Schedule</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('laporan_mps.index') }}" class="breadcrumb-link">Laporan Master Production Schedule</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Laporan Master Production Schedule</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- ============================================================== -->
        <!-- data table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Laporan Master Production Schedule</h5>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <td>
                                    Id MPS
                                </td>
                                <td>&nbsp;:&nbsp;</td>
                                <td>{{$pesanan->id_mps}}</td>
                            </tr>

                            <tr>
                                <td>
                                    Nama Produk
                                </td>
                                <td>&nbsp;:&nbsp;</td>
                                <td>{{ $pesanan->nama_produk}}</td>
                            </tr>
                        </table>


                        {{-- <br>
                        <br>
                        <br>
                        <p><b>DAFTAR BAHAN BAKU:</b></p> --}}

                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Id Pesanan</th>
                                    <th scope="col">Jumlah Pesanan</th>
                                    <th scope="col">Jadwal Produksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($detail as $no => $mp)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $mp->id_pesanan }}</td>
                                        <td>{{ $mp->jumlah_pesanan }}</td>
                                        <td>{{ $mp->jadwal_detail_produksi }}</td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>



                    </div>
                </div>
                <div class="col-sm-6 pl-0">
                    <p class="text-center">
                        <a type="button" class="btn btn-space btn-secondary" href="{{ route('laporan_mps.index') }}">Kembali</a>
                        <a type="button" class="btn btn-space badge-primary" href="/cetaklaporanmps/{{ $pesanan->id_mps }}">Cetak PDF</a>
                    </p>
                </div>
            </div>

        </div>

    </div>
@endsection
