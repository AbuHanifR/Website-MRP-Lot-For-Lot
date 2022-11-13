@extends('admin.main')
@section('content')

<div class="row">
    <div class="col-md-12">
        @if(session()->has('message'))
        <div class="alert alert-danger">
            {{session('message')}}
        </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Bahan Baku Keluar</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="breadcrumb-link">Bahan Baku Keluar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bahan Baku Keluar</li>
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
                    <h3 class="card-header m-4 text-left">Daftar Bahan Baku Keluar</h3>
                    <div class="col text-right m-4">
                        <a href="{{route('bahan_baku_keluar.create') }}" class="btn btn-primary mb-1">Tambah Bahan Baku Keluar</a>
                    </div>
                </div>
            </div>




            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Id Transaksi</th>
                                {{-- <th scope="col">Nama Bahan Baku</th>
                                <th scope="col">Jumlah Keluar</th> --}}
                                <th scope="col">Tanggal Keluar</th>
                                <th scope="col">Keperluan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $no => $trs)
                            <tr>
                                <td>{{$transaksi->firstItem()+$no}}</td>
                                <td>{{ $trs->id_transaksi_keluar}}</td>                            
                                {{-- <td>{{ $trs->nama_bahan_baku }}</td>
                                <td>{{ $trs->jumlah_keluar}}</td> --}}
                                <td>{{ $trs->tanggal_keluar}}</td>
                                <td>{{ $trs->keperluan}}</td>
                                <td>
                                    <a href="bahan_baku_keluar/{{ $trs->id_transaksi_keluar}}" class="badge badge-pill badge-primary">Detail</a>
                                    <a href="bahan_baku_keluar/edit/{{ $trs->id_transaksi_keluar }}" class="badge badge-pill badge-warning">Ubah</a>
                                    <a href="bahan_baku_keluar/destroy/{{ $trs->id_transaksi_keluar }}" class="badge badge-pill badge-danger">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <div>
                        Showing
                        {{ $transaksi->firstItem()}}
                        of
                        {{ $transaksi->lastItem()}}
                    </div>
                    <div class="pull-right">
                        {{ $transaksi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection