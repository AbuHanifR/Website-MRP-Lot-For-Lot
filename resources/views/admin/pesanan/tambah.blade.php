@extends('admin.main')
@section('content')



    <!-- Pageheader -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Tambah Pesanan Produk</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="breadcrumb-link">Pesanan Produk</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('pesanan.index') }}"
                                    class="breadcrumb-link">Pesanan Produk</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Pesanan Produk</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- end pageheader -->

    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Tambah Pesanan Produk</h5>
                    <div class="card-body">
                        <form id="formheader" action="/pesanan/simpandata" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-sm-5 col-md-6">
                                    <div class="form-group">
                                        <label for="id_pesanan">Id Pesanan Produk</label>
                                        <input type="text" class="form-control" name="id_pesanan" placeholder="id_pesanan" value="{{$kode}}" readonly>
                                        {!! $errors->first('kode', "<p class='invalid-feedback'>:message</p>") !!}
                                    </div>
                                </div>

                                <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                                    <div class="form-group {{ $errors->has('tanggal_pesanan') ? 'has-error' : 'has-success' }}">
                                        <div class="form-group">
                                            <label for="tanggal_pesanan">Tanggal Pesanan Produk</label>
                                            <input type="date" class="form-control" name="tanggal_pesanan" value="{{date_format($tanggal, "Y-m-d")}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                                    <div class="form-group {{ $errors->has('jadwal_produksi') ? 'has-error' : 'has-success' }}">
                                        <div class="form-group">
                                            <label for="jadwal_produksi">Due Date</label>
                                            <input id="jadwal_produksi" value="{{$jadwal_produksi}}" type="date" class="form-control" name="jadwal_produksi" placeholder="jadwal_produksi">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            


                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <!-- ============================================================== -->
            <!-- basic form -->
            <!-- ============================================================== -->
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Detail Tambah Pesanan Produk</h5>
                    <div class="card-body">
    
    
                        <form action="/pesanan" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="tanggal_produksi" id="tanggal_produksi" value="{{$jadwal_produksi}}">
    
                            

                               
                           
    
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
                                            <option value="{{ $produk->id_produk}}">
                                                {{$produk->nama_produk}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0">
                                    <div class="form-group">
                                        <label for="jumlah_pesanan">Jumlah Pesanan Produk</label>
                                        <input type="text" class="form-control" name="jumlah_pesanan" placeholder="jumlah_pesanan">
                                    </div>
                                    @error('jumlah_pesanan')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                            </div>
    
                            <div class="row">
                                {{-- <div class="col-sm-6 col-md-5 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama_bahan_baku">Nama Bahan Baku</label>
                                        <select class="form-control" id="nama_bahan_baku" name="nama_bahan_baku">
                                            @foreach ($bahan as $bahan)
                                            <option value="{{ $bahan->id_bahan_baku}}">
                                                {{$bahan->nama_bahan_baku}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                

                                
    
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
                                <p><b>DAFTAR PESANAN PRODUK:</b></p>
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width:10px;">No.</th>
                                            
                                            <th>Nama Produk</th>
                                            <th>Jumlah Pesanan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                       
                                        @foreach ($produk2 as $prd)
                                        @foreach ($pesanan as $ps)
                                        @if($prd->id_produk==$ps['nama_produk'])
                                      
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            
                                            <td>{{ $prd->nama_produk}}</td>
                                            <td>{{ $ps['jumlah_pesanan'] }}</td>
    
                                            <td> <a href="/pesanan/hapusdata/{{$ps['nama_produk']}}" class="badge badge-pill badge-danger">Hapus</a></td>
                                        </tr>
                                        @endif
                                    
                                      
                                        @endforeach
                                        @endforeach
    
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
    
                        
                            <div class="col-sm-6 pl-0">
                                <p class="text-right">
                                    <button id="btnsimpan" type="submit" class="btn btn-primary">Simpan</button>
                                    <a type="button" class="btn btn-space btn-secondary" href="{{route('pesanan.index')}}">Batal</a>
                                </p>
                            </div>
    
                       
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#btnsimpan').on('click', function(){
            $('#formheader').submit()
        })
        $('#jadwal_produksi').on('change', function(){
            var tanggal=$(this).val()
            $('#tanggal_produksi').val(tanggal)
        })
    })
</script>
@endsection
