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
            <h2 class="pageheader-title">Bill Of Material</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="breadcrumb-link">BoM</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bill Of Material</li>
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
                    <h3 class="card-header m-4 text-left">Daftar Bill Of Material</h3>
                    <div class="col text-right m-4">
                        <a href="{{route('bom.create') }}" class="btn btn-primary mb-1">Tambah BoM</a>
                    </div>
                </div>
            </div>




            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Id BoM</th>
                                <th scope="col">Nama Produk</th>
                                {{-- <th scope="col">Nama Bahan Baku</th>
                                <th scope="col">Jumlah Bahan</th> --}}
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bom as $no => $bm)
                            <tr>
                                <td>{{ $bom->firstItem()+$no}}</td>
                                <td>{{ $bm->id_bom}}</td>
                                <td>{{ $bm->nama_produk}}</td>
                                {{-- <td>{{ $bm->nama_bahan_baku}}</td>
                                <td>{{ $bm->jumlah_bahan}}</td> --}}
                                <td>
                                    <a href="bom/detail/{{ $bm->id_bom}}" class="badge badge-pill badge-primary">Detail</a>
                                    <a href="bom/edit/{{ $bm->id_bom}}" class="badge badge-pill badge-warning">Ubah</a>
                                    <a href="bom/destroy/{{ $bm->id_bom}}" class="badge badge-pill badge-danger delete-confirm">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                    <br>
                    <div>
                        Showing
                        {{ $bom->firstItem()}}
                        of
                        {{ $bom->lastItem()}}
                    </div>
                    <div class="pull-right">
                        {{ $bom->links() }}
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