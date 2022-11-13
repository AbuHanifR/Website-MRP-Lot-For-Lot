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
            <h2 class="pageheader-title">Pesanan Produk</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="breadcrumb-link">Pesanan Produk</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pesanan Produk</li>
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
                    <h3 class="card-header m-4 text-left">Daftar Pesanan Produk</h3>
                    <div class="col text-right m-4">
                        <a href="{{route('pesanan.create') }}" class="btn btn-primary mb-1">Tambah Pesanan</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Id Pesanan Produk</th>
                                <th scope="col">Tanggal Pesanan Produk</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan as $no => $psn)
                            <tr>
                                <td>{{ $pesanan->firstItem()+$no}}</td>
                                <td>{{ $psn->id_pesanan}}</td>
                                <td>{{ $psn->tanggal_pesanan}}</td>
                                <td>{{ $psn->jadwal_produksi}}</td>
                                <td>
                                    <a href="pesanan/detail/{{ $psn->id_pesanan}}" class="badge badge-pill badge-primary">Detail</a>
                                    <a href="pesanan/edit/{{ $psn->id_pesanan}}" class="badge badge-pill badge-warning">Ubah</a>
                                    <a href="pesanan/destroy/{{ $psn->id_pesanan}}" class="badge badge-pill badge-danger delete-confirm">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <div>
                        Showing
                        {{ $pesanan->firstItem()}}
                        of
                        {{ $pesanan->lastItem()}}
                    </div>
                    <div class="pull-right">
                        {{ $pesanan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('script')
    <script>
        $('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Apakah Yakin?',
        text: 'Data Akan Di Hapus Secara Permanen',
        icon: 'warning',
        buttons: ["Batal", "Iya"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});
    </script>
@endsection