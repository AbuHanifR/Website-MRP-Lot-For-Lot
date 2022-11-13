@extends('admin.main')
@section('content')



    <!-- Pageheader -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Material Requirement Planning</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="breadcrumb-link">Material Requirement Planning</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('mrp.index') }}" class="breadcrumb-link">Material
                                    Requirement Planning</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Material Requirement Planning</li>
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
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Material Requirement Planning</h5>
                    <div class="card-body">


                        <form action="{{ route('mrp.hitung', [$id]) }}" method="GET" enctype="multipart/form-data">
                            @csrf

                            {{-- <div class="row">
                                <div class="col-sm-5 col-md-6">
                                    <div class="form-group">
                                        <label for="id_mps">Id MPS</label>
                                        <input type="text" class="form-control" name="id_mps" placeholder="id_mps" value="{{$kode}}" readonly>
                                        {!! $errors->first('kode', "<p class='invalid-feedback'>:message</p>") !!}
                                    </div>
                                </div>
                            </div> --}}


                            {{-- <div class="row">
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

                                
                            </div> --}}

                            <div class="row">
                                <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                                    <div class="form-group {{ $errors->has('bulan_mrp') ? 'has-error' : 'has-success' }}">
                                        <div class="form-group">
                                            <label for="bulan">Bulan</label>
                                            <input type="month" class="form-control" name="bulan" placeholder="bulan">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 22px;">Hitung</button>
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
                                <p><b>Nama Produk:</b></p>
                                <table class="table table-hover table-striped" style="background-color: yellow;">
                                    <thead>
                                        <tr>
                                            {{-- <th style="width:40px;">No.</th> --}}
                                            <th>Nama Produk</th>
                                            <th>Minggu 1</th>
                                            <th>Minggu 2</th>
                                            <th>Minggu 3</th>
                                            <th>Minggu 4</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if ($mps)
                                        @foreach ($mps as $item)
                                            
                                        


                                            <tr>
                                                <td>{{ $item->nama_produk }}</td>
                                                <td>{{ $item->minggu_1 }}</td>
                                                <td>{{ $item->minggu_2 }}</td>
                                                <td>{{ $item->minggu_3 }}</td>
                                                <td>{{ $item->minggu_4 }}</td>

                                                {{-- <td> <a href="/mps/hapusdata/{{$pms->nama_produk}}" class="badge badge-pill badge-danger">Hapus</a></td> --}}
                                            </tr>


                                            @endforeach
                                        @endif

                                    </tbody>
                                    
                                </table>

                            </div>
                            <br>
                            <p><b>MRP:</b></p>
                            @if ($detailmrp)
                                @foreach ($detailmrp as $dtm)


                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                {{-- <th style="width:40px;">No.</th> --}}
                                                <th>Bahan Baku</th>
                                                <th>Minggu</th>
                                                {{-- <th>Tanggal</th> --}}
                                                <th>GR</th>
                                                <th>SR</th>
                                                <th>OHI</th>
                                                <th>NR</th>
                                                <th>POR</th>
                                                <th>PORel</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @foreach ($dtm['detail'] as $item)
                                                @php
                                                    $tanggal = date('d', strtotime($item->bulan_mrp));
                                                    if ($tanggal >= 1 && $tanggal <= 7) {
                                                        $hasil = 'minggu_1';
                                                    } elseif ($tanggal >= 8 && $tanggal <= 14) {
                                                        $hasil = 'minggu_2';
                                                    } elseif ($tanggal >= 15 && $tanggal <= 21) {
                                                        $hasil = 'minggu_3';
                                                    } elseif ($tanggal >= 22 && $tanggal <= 31) {
                                                        $hasil = 'minggu_4';
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>{{ $item->nama_bahan_baku }}</td>
                                                    <td>{{ $hasil }}</td>
                                                    {{-- <td>{{ $item->bulan_mrp}}</td> --}}
                                                    <td>{{ $item->GR }}</td>
                                                    <td>{{ $item->SR }}</td>
                                                    <td>{{ $item->OHI }}</td>
                                                    <td>{{ $item->NR }}</td>
                                                    <td>{{ $item->POR }}</td>
                                                    <td>{{ $item->PORel }}</td>
                                                    {{-- <td> <a href="/mps/hapusdata/{{$pms->nama_produk}}" class="badge badge-pill badge-danger">Hapus</a></td> --}}
                                                </tr>
                                            @endforeach



                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                {{-- <th></th> --}}
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>

                                    </table>
                                @endforeach
                            @endif

                        </div>

                        {{-- <form action="{{route('mrp.store')}}" method="POST">
                            @csrf
                            <div class="col-sm-6 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a type="button" class="btn btn-space btn-secondary" href="{{route('mrp.index')}}">Batal</a>
                                </p>
                            </div>
    
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
