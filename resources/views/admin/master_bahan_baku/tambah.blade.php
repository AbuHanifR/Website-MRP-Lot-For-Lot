@extends('admin.main')
@section('content')
    <!-- Pageheader -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Tambah Bahan Baku</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="breadcrumb-link">Bahan Baku</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('master_bahan_baku.index') }}"
                                    class="breadcrumb-link">Master Bahan Baku</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Bahan Baku</li>
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
                <h5 class="card-header">Form Tambah Bahan Baku</h5>
                <div class="card-body">


                    <form action="/master_bahan_baku" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="id_bahan_baku">Id Bahan Baku</label>
                            <input type="text" class="form-control" name="id_bahan_baku" placeholder="Id Bahan Baku"
                                value="{{ $kode }}" readonly>
                            {!! $errors->first('kode', "<p class='invalid-feedback'>:message</p>") !!}
                        </div>
                        <div class="form-group">
                            <label for="nama_bahan_baku">Nama Bahan Baku</label>
                            <input type="text" class="form-control" name="nama_bahan_baku" placeholder="Nama Bahan Baku">
                            
                            @error('nama_bahan_baku')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                            <select class="form-control" id="nama_bahan_baku" name="satuan">
                               <option value="Meter">Meter</option>
                               <option value="Unit">Unit</option>
                               <option value="Batang">Batang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="text" class="form-control col-xl-3" name="stok" placeholder="Stok">
                            @error('stok')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                      

                        <div class=" ">
                            <p class="text-center">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                                <a type="button" class="btn btn-space btn-secondary"
                                    href="{{ route('master_bahan_baku.index') }}">Batal</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
