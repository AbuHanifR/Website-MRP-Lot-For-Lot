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
            <h2 class="pageheader-title">Master Bahan Baku</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="breadcrumb-link">Bahan Baku</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Master Bahan Baku</li>
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
                    <h3 class="card-header m-4 text-left">Daftar Bahan Baku</h3>
                    <div class="col text-right m-4">
                        <a href="{{route('master_bahan_baku.create') }}" class="btn btn-primary mb-1">Tambah Bahan Baku</a>
                    </div>
                </div>
            </div>




            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Id Bahan Baku</th>
                                <th scope="col">Nama Bahan Baku</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Stok</th>
                                {{-- <th scope="col">Lead Time</th> --}}
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bahan as $no => $bhn)
                            <tr>
                                <td>{{ $bahan->firstItem()+$no}}</td>
                                <td>{{ $bhn->id_bahan_baku}}</td>
                                <td>{{ $bhn->nama_bahan_baku }}</td>
                                <td>{{ $bhn->satuan }}</td>
                                <td>{{ $bhn->stok }}</td>
                                {{-- <td>{{ $bhn->leadtime }}</td> --}}
                                <td>
                                    <a href="master_bahan_baku/edit/{{ $bhn->id_bahan_baku }}" class="badge badge-pill badge-warning">Ubah</a>
                                    <a href="master_bahan_baku/destroy/{{ $bhn->id_bahan_baku }}" class="badge badge-pill badge-danger delete-confirm">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                       
                    </table>
                    <br>
                    <div>
                        Showing
                        {{ $bahan->firstItem()}}
                        of
                        {{ $bahan->lastItem()}}
                    </div>
                    <div class="pull-right">
                        {{ $bahan->links() }}
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