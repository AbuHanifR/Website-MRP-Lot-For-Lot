@extends('admin.main')
@section('content')



    <!-- Pageheader -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Tambah Master Production Schedule</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="breadcrumb-link">Master Production Schedule</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('mps.index') }}"
                                    class="breadcrumb-link">Master Production Schedule</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Master Production Schedule</li>
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
                    <h5 class="card-header">Tambah Master Production Schedule</h5>
                    <div class="card-body">
    
    
                        <form action="{{route('mps.create')}}" method="GET" enctype="multipart/form-data">
                            @csrf
    
                            <div class="row">
                                <div class="col-sm-5 col-md-6">
                                    <div class="form-group">
                                        <label for="id_mps">Id MPS</label>
                                        <input type="text" class="form-control" name="id_mps" placeholder="id_mps" value="{{$kode}}" readonly>
                                        {!! $errors->first('kode', "<p class='invalid-feedback'>:message</p>") !!}
                                    </div>
                                </div>
                            </div>
                                {{-- <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                                    <div class="form-group {{ $errors->has('tanggal_pesanan') ? 'has-error' : 'has-success' }}">
                                        <div class="form-group">
                                            <label for="tanggal_pesanan">Tanggal Pesanan</label>
                                            <input type="date" class="form-control" name="tanggal_pesanan" placeholder="tanggal_pesanan">
                                        </div>
                                    </div>
                                </div> --}}
                            
    
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

                                
                            </div>

                            <div class="row">
                            <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                                <div class="form-group {{ $errors->has('bulan') ? 'has-error' : 'has-success' }}">
                                    <div class="form-group">
                                        <label for="bulan">Bulan</label>
                                        <input type="month" class="form-control" name="bulan" placeholder="bulan">
                                    </div>
                                </div>
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
                                {{-- <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0">
                                    <div class="form-group">
                                        <label for="jumlah_pesanan">Jumlah Pesanan</label>
                                        <input type="text" class="form-control" name="jumlah_pesanan" placeholder="jumlah_pesanan">
                                    </div>
                                </div>--}}

                                
    
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 22px;">Filter</button>
                                </div>
                            </div>
                        </form>
    
    
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
                                <p><b>DAFTAR PESANAN:</b></p>
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width:10px;">No.</th>
                                            <th>Id Pesanan</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah Pesanan</th>
                                            <th>Tanggal Produksi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                       @if (session()->has('pemesanan'))
                                           
                                        @foreach (session('pemesanan') as $pms)
                                        
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{$pms->id_detail_pesanan}}</td>
                                            <td>{{ $pms->nama_produk}}</td>
                                            <td>{{ $pms->jumlah_pesanan}}</td>
                                            <td>{{ $pms->jadwal_produksi}}</td>
    
                                            <td> <a href="/mps/hapusdata/{{$pms->nama_produk}}" class="badge badge-pill badge-danger">Hapus</a></td>
                                        </tr>
                                        
                                        @endforeach

                                        @endif
    
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
    
                        <form action="{{route('mps.store')}}" method="POST">
                            @csrf
                            <div class="col-sm-6 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a type="button" class="btn btn-space btn-secondary" href="{{route('mps.hapus_session')}}">Batal</a>
                                </p>
                            </div>
    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
