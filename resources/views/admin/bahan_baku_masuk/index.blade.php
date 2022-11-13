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
            <h2 class="pageheader-title">Bahan Baku Masuk</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="breadcrumb-link">Bahan Baku Masuk</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bahan Baku Masuk</li>
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
                    <h3 class="card-header m-4 text-left">Daftar Bahan Baku Masuk</h3>
                    <div class="col text-right m-4">
                        <a href="{{route('bahan_baku_masuk.create') }}" class="btn btn-primary mb-1">Tambah Bahan Baku Masuk</a>
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
                                <th scope="col">Jumlah Masuk</th> --}}
                                <th scope="col">Tanggal Masuk</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $no => $trs)
                            <tr>
                                <td>{{$transaksi->firstItem()+$no}}</td>
                                <td>{{ $trs->id_transaksi_masuk}}</td>                            
                                {{-- <td>{{ $trs->nama_bahan_baku }}</td>
                                <td>{{ $trs->jumlah_masuk }}</td> --}}
                                <td>{{ $trs->tanggal_masuk }}</td>
                                <td>
                                    <a href="bahan_baku_masuk/{{ $trs->id_transaksi_masuk}}" class="badge badge-pill badge-primary">Detail</a>
                                    <a href="bahan_baku_masuk/edit/{{ $trs->id_transaksi_masuk }}" class="badge badge-pill badge-warning">Ubah</a>
                                    <a href="bahan_baku_masuk/destroy/{{ $trs->id_transaksi_masuk }}" class="badge badge-pill badge-danger">Hapus</a>
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