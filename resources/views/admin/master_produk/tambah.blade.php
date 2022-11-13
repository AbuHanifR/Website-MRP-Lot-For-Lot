@extends('admin.main')
@section('content')

    <!-- Pageheader -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Tambah Produk</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="breadcrumb-link">Produk</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('master_produk.index') }}"
                                    class="breadcrumb-link">Master Produk</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Produk</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- end pageheader -->

    <div class="row">
        <!-- ============================================================== -->
        <!-- basic form -->
        <!-- ============================================================== -->
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Form Tambah Produk</h5>
                <div class="card-body">


                    <form action="/master_produk" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group ">
                            <label for="id_produk">Id Produk</label>
                            <input type="text" class="form-control" name="id_produk" placeholder="Id Produk"
                                value="{{ $kode }}" readonly>
                            {!! $errors->first('kode', "<p class='invalid-feedback'>:message</p>") !!}
                        </div>

                        <div class="form-group ">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" class="form-control" name="nama_produk" placeholder="Nama Produk">
                            <br>

                            @error('nama_produk')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class=" ">
                            <p class="text-center">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                                <a type="button" class="btn btn-space btn-secondary"
                                    href="{{ route('master_produk.index') }}">Batal</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
