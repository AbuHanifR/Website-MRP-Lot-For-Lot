@extends('admin.main')
@section('content')

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Detail Pesanan Produk</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="breadcrumb-link">Pesanan Produk</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('pesanan.index') }}" class="breadcrumb-link">Pesanan Produk</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Pesanan Produk</li>
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
                    <h5 class="mb-0">Detail Pesanan Produk</h5>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <td>
                                    Id Pesanan Produk
                                </td>
                                <td>&nbsp;:&nbsp;</td>
                                <td>{{$produk->id_pesanan}}</td>
                            </tr>

                            <tr>
                                <td>
                                    Tanggal Pesanan Produk
                                </td>
                                <td>&nbsp;:&nbsp;</td>
                                <td>{{ $produk->tanggal_pesanan}}</td>
                            </tr>

                            <tr>
                                <td>
                                    Due Date
                                </td>
                                <td>&nbsp;:&nbsp;</td>
                                <td>{{ $produk->jadwal_produksi}}</td>
                            </tr>
                        </table>

                        <br>
                        <br>
                        <p><b>DAFTAR PESANAN PRODUK:</b></p>

                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Id Pesanan Produk</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Jumlah Pesanan</th>
                                </tr>
                            </thead>

                            <tbody>
                               
                                @foreach ($detail as $no => $ps)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $ps->id_pesanan }}</td>
                                        <td>{{ $ps->nama_produk }}</td>
                                        <td>{{ $ps->jumlah_pesanan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>



                    </div>
                </div>
                <div class="col-sm-6 pl-0">
                    <p class="text-center">
                        <a type="button" class="btn btn-space btn-secondary" href="{{ route('pesanan.index') }}">Kembali</a>
                    </p>
                </div>
            </div>

        </div>

    </div>
@endsection
