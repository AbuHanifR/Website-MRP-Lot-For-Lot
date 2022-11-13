@extends('admin.main')
@section('content')
    <!-- Pageheader -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Ubah Pesanan</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="breadcrumb-link">Pesanan</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('pesanan.index') }}"
                                    class="breadcrumb-link">Pesanan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ubah Pesanan</li>
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
                <h5 class="card-header">Form Ubah Pesanan</h5>
                <div class="card-body">

                    <form action="{{ route('detailpesanan.update', [$detail->id_detail_pesanan]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="id_pesanan">Id Pesanan</label>
                            <input type="text" class="form-control" name="id_pesanan" value="{{ $data->id_pesanan }}"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <select class="form-control" id="nama_produk" name="nama_produk">
                                @foreach ($produk as $produk)
                                    <option @if ($detail->id_produk == $produk->id_produk) selected @endif disabled
                                        value="{{ $produk->id_produk }}">
                                        {{ $produk->nama_produk }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jumlah_pesanan">Jumlah Pesanan</label>
                            <input type="text" class="form-control col-xl-3" name="jumlah_pesanan" placeholder="jumlah_pesanan"
                                value="{{ $detail->jumlah_pesanan }}">

                            @error('jumlah_pesanan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <p class="text-center">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                                <a type="button" class="btn btn-space btn-secondary"
                                    href="{{ route('pesanan.index') }}">Batal</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
