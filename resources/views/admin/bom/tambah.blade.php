@extends('admin.main')
@section('content')
    <!-- Pageheader -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Tambah Bill Of Material</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="breadcrumb-link">BOM</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('bom.index') }}" class="breadcrumb-link">Bill Of
                                    Material</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Bill Of Material</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- end pageheader -->
    <div class="container">
        <div class="row">
            <!-- ============================================================== -->
            <!-- basic form -->
            <!-- ============================================================== -->
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Tambah Bill Of Material</h5>
                    <div class="row">
                        <div class="col-md-12">
                            @if(session()->has('message'))
                            <div class="alert alert-danger">
                                {{session('message')}}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">


                        <form action="/bom" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-sm-5 col-md-6">
                                    <div class="form-group">
                                        <label for="id_bom">Id BOM</label>
                                        <input type="text" class="form-control" name="id_bom" placeholder="id_bom"
                                            value="{{ $kode }}" readonly>
                                        {!! $errors->first('kode', "<p class='invalid-feedback'>:message</p>") !!}
                                    </div>
                                </div>
                                {{-- <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                                <div class="form-group {{ $errors->has('tanggal_masuk') ? 'has-error' : 'has-success' }}">
                                    <div class="form-group">
                                        <label for="tanggal_masuk">Tanggal Masuk</label>
                                        <input type="date" class="form-control" name="tanggal_masuk" placeholder="tanggal_masuk">
                                    </div>
                                </div>
                            </div> --}}
                            </div>

                            {{-- <div class="row">
                            <div class="col-sm-6 col-md-5 col-lg-6">
                                <div class="form-group">
                                    <label for="nama_penerima">Penerima</label>
                                    <input type="text" class="form-control" name="nama_penerima" placeholder="nama_penerima" value="{{ Auth::user()->name }}" readonly>
                                </div>
                            </div>
                        </div> --}}

                            <div class="row">
                                <div class="col-sm-6 col-md-5 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama_produk">Nama Produk</label>
                                        <select class="form-control" id="nama_produk" name="nama_produk">
                                            @foreach ($produk as $produk)
                                                <option value="{{ $produk->id_produk }}">
                                                    {{ $produk->nama_produk }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0">
                                    <div class="form-group">
                                        <label for="jumlah_bahan">Jumlah Bahan</label>
                                        <input type="text" class="form-control" name="jumlah_bahan"
                                            placeholder="jumlah_bahan">
                                    </div>
                                    @error('jumlah_bahan')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-sm-6 col-md-5 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama_bahan_baku">Nama Bahan Baku</label>
                                        <select class="form-control" id="nama_bahan_baku" name="nama_bahan_baku">
                                            @foreach ($bahan as $bahan)
                                                <option value="{{ $bahan->id_bahan_baku }}" data-satuan="{{$bahan->satuan}}">
                                                    {{ $bahan->nama_bahan_baku }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                

                                <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0">
                                    <div class="form-group">
                                        <label for="satuan">Satuan</label>
                                        <input id="satuan" type="text" class="form-control" name="satuan"
                                            placeholder="satuan" readonly>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 22px;">Tambah</button>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-6">

                                </div>
                                <div class="col-6">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">


                                </div>
                                <div class="col-4">

                                </div>

                                <div class="col-4">



                                </div>
                            </div>



                            <!-- Bahan Masuk -->                             

                        </form>

                        <br>
                        <br>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <p><b>DAFTAR BOM:</b></p>
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width:10px;">No.</th>
                                            <th>Id Bom</th>
                                            <th>Nama Produk</th>
                                            <th>Nama Bahan Baku</th>
                                            <th>Jumlah Bahan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($bahan2 as $bhn1)
                                            @foreach ($produk2 as $prd)
                                                @foreach ($bom as $bm)
                                                    @if ($bhn1->id_bahan_baku == $bm['nama_bahan_baku'])
                                                        @if ($prd->id_produk == $bm['nama_produk'])
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $bm['id_bom'] }}</td>
                                                                <td>{{ $prd->nama_produk }}</td>
                                                                <td>{{ $bhn1->nama_bahan_baku }}</td>
                                                                <td>{{ $bm['jumlah_bahan'] }}</td>

                                                                <td> <a href="/bom/hapusdata/{{ $bm['nama_bahan_baku'] }}"
                                                                        class="badge badge-pill badge-danger">Hapus</a></td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row">

                        <form action="/bom/simpandata" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-10">
                                        <div class="form-group">
                                        <label for="gambar_bom">Gambar BOM</label>
                                        <input type="file" name="gambar_bom" id="" class="form-control">
                                        </div>
                                    </div>
                                </div>  
                            <div class="col-sm-6 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a type="button" class="btn btn-space btn-secondary"
                                        href="{{ route('bom.index') }}">Batal</a>
                                </p>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#nama_bahan_baku').on('change',function(){
            var satuan=$(this).find(':selected').data('satuan')
            $('#satuan').val(satuan)
        })
    })
</script>
@endsection
