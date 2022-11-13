@extends('admin.main')
@section('content')

<!-- Pageheader -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Ubah Bahan Baku Masuk</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="breadcrumb-link">Bahan Baku Masuk</a></li>
                        <li class="breadcrumb-item"><a href="{{route('bahan_baku_masuk.index') }}" class="breadcrumb-link">Bahan Baku Masuk</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ubah Bahan Baku Masuk</li>
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
            <h5 class="card-header">Form Ubah Bahan Baku Masuk</h5>
            <div class="card-body">

                <form action="{{route('detailbahanbakumasuk.update',[$detail->id_detail_bahan_baku_masuk])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="id_bahan_baku">Id Bahan Baku</label>
                        <input type="text" class="form-control" name="id_bahan_baku" value="{{ $detail->id_bahan_baku}}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nama_bahan_baku">Nama Bahan Baku</label>
                        <select class="form-control" id="nama_bahan_baku" name="nama_bahan_baku">
                            @foreach ($bahan as $bahan)
                            <option @if($detail->id_bahan_baku==$bahan->id_bahan_baku) selected @endif disabled value="{{ $bahan->id_bahan_baku}}">
                                {{$bahan->nama_bahan_baku}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jumlah_masuk">Jumlah Masuk</label>
                        <input type="text" class="form-control col-xl-3" name="jumlah_masuk" placeholder="jumlah_masuk" value="{{ $detail->jumlah_masuk}}">
                        @error('jumlah_masuk')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    
                    <div class="">
                        <p class="text-center">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                            <a type="button" class="btn btn-space btn-secondary" href="{{route('bahan_baku_masuk.index')}}">Batal</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection