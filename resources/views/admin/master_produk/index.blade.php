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
            <h2 class="pageheader-title">Master Produk</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="breadcrumb-link">Produk</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Master Produk</li>
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
                    <h3 class="card-header m-4 text-left">Daftar Produk</h3>
                    <div class="col text-right m-4">
                        <a href="{{route('master_produk.create') }}" class="btn btn-primary mb-1">Tambah Produk</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Id Produk</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $no => $prd)
                            <tr>
                                <td>{{ $produk->firstItem()+$no}}</td>
                                <td>{{ $prd->id_produk}}</td>
                                <td>{{ $prd->nama_produk}}</td>
                                <td>
                                    <a href="master_produk/edit/{{ $prd->id_produk}}" class="badge badge-pill badge-warning">Ubah</a>
                                    <a href="master_produk/destroy/{{ $prd->id_produk}}" class="badge badge-pill badge-danger delete-confirm">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                    <br>
                    <div>
                        Showing
                        {{ $produk->firstItem()}}
                        of
                        {{ $produk->lastItem()}}
                    </div>
                    <div class="pull-right">
                        {{ $produk->links() }}
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