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
                <h2 class="pageheader-title">Laporan Bahan Baku Masuk</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="breadcrumb-link">Laporan Bahan Baku Masuk</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Laporan Bahan Baku Masuk</li>
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
                        <h3 class="card-header m-4 text-left">Laporan Bahan Baku Masuk</h3>
                    </div>
                </div>

                <div class="card-body">
                    <form action="/laporan_masuk" method="GET">
                        @csrf
                        <input type="hidden" name="status" class="status">
                            <input type="Month" name="filter" placeholder=" " value="{{ old('filter') }}">
                            <input type="submit" value="filter" class="btn btn-primary mb-1">
                            <input type="submit" nama="cetak" value="cetak" class="btn btn-success mb-1 cetak">
                    </form>

                    <br>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Id Transaksi</th>
                                    <th scope="col">Nama Bahan Baku</th>
                                    <th scope="col">Jumlah Masuk</th>
                                    <th scope="col">Tanggal Masuk</th>
                                    {{-- <th scope="col">Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporan as $no => $lpn)
                                    <tr>
                                        <td>{{ $laporan->firstItem() + $no }}</td>
                                        <td>{{ $lpn->id_transaksi_masuk }}</td>
                                        <td>{{ $lpn->nama_bahan_baku }}</td>
                                        <td>{{ $lpn->jumlah_masuk }}</td>
                                        <td>{{ $lpn->tanggal_masuk }}</td>
                                        {{-- <td>
                                    <a href="bahan_baku_masuk/{{ $trs->id_transaksi_masuk}}" class="badge badge-pill badge-primary">Detail</a>
                                    <a href="bahan_baku_masuk/edit/{{ $trs->id_transaksi_masuk }}" class="badge badge-pill badge-warning">Ubah</a>
                                    <a href="bahan_baku_masuk/destroy/{{ $trs->id_transaksi_masuk }}" class="badge badge-pill badge-danger">Hapus</a>
                                </td> --}}
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
                            {{ $laporan->appends(['filter'=>session('filter')])->links() }}
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

