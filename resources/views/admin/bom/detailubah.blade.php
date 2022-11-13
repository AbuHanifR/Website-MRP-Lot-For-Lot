@extends('admin.main')
@section('content')
    <!-- Pageheader -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Ubah Bill Of Material</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="breadcrumb-link">BOM</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('bom.index') }}" class="breadcrumb-link">Bill Of
                                    Material</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ubah Bill Of Material</li>
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
                <h5 class="card-header">Form Ubah Bill Of Material</h5>
                <div class="card-body">

                    <form action="{{ route('detailbom.update', [$detail->id_detail_bom]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="id_bom">Id BOM</label>
                            <input type="text" class="form-control" name="id_bom" value="{{ $data->id_bom }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" class="form-control" name="nama_produk" placeholder="nama_produk"
                                value="{{ $data->nama_produk }}" readonly>
                        </div>

                        {{-- <div class="form-group">
                        <label for="nama_bahan_baku">Nama Bahan Baku</label>
                        <input type="text" class="form-control" name="nama_bahan_baku" placeholder="nama_bahan_baku" value="{{ $detail->nama_bahan_baku}}">
                    </div> --}}

                        <div class="form-group">
                            <label for="nama_bahan_baku">Nama Bahan Baku</label>
                            <select class="form-control" id="nama_bahan_baku" name="nama_bahan_baku">
                                @foreach ($bahan as $bahan)
                                    <option @if ($detail->id_bahan_baku == $bahan->id_bahan_baku) selected @endif disabled
                                        value="{{ $bahan->id_bahan_baku }}">
                                        {{ $bahan->nama_bahan_baku }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jumlah_bahan">Jumlah Bahan</label>
                            <input type="text" class="form-control col-xl-3" name="jumlah_bahan" placeholder="jumlah_bahan"
                                value="{{ $detail->jumlah_bahan }}">
                            @error('jumlah_bahan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <p class="text-center">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                                <a type="button" class="btn btn-space btn-secondary"
                                    href="{{ route('bom.index') }}">Batal</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
