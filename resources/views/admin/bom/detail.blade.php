@extends('admin.main')
@section('content')

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Detail Bill Of Material</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="breadcrumb-link">BoM</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('bom.index') }}" class="breadcrumb-link">Bill Of
                                    Material</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Bill Of Material</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- ============================================================== -->
        <!-- data table  -->
        <!-- ============================================================== -->
        
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Detail Bill Of Material</h5>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <td>
                                    Id BOM
                                </td>
                                <td>&nbsp;:&nbsp;</td>
                                <td>{{$bom->id_bom}}</td>
                            </tr>

                            <tr>
                                <td>
                                    Nama Produk
                                </td>
                                <td>&nbsp;:&nbsp;</td>
                                <td>{{ $bom->nama_produk}}</td>
                            </tr>
                        </table>


                        <br>
                        <br>
                        <br>
                        <p><b>DAFTAR BAHAN BAKU:</b></p>

                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Id Bahan Baku</th>
                                    <th scope="col">Nama Bahan Baku</th>
                                    <th scope="col">Jumlah Bahan</th>
                                </tr>
                            </thead>

                            <tbody>
                               
                                @foreach ($detail as $no => $bm)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $bm->id_bahan_baku }}</td>
                                        <td>{{ $bm->nama_bahan_baku }}</td>
                                        <td>{{ $bm->jumlah_bahan }}</td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>



                    </div>
                </div>
                <div class="col-sm-6 pl-0">
                    <p class="text-center">
                        <a type="button" class="btn btn-space btn-secondary" href="{{ route('bom.index') }}">Kembali</a>
                    </p>
                </div>
            </div>

        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <img src="{{ asset('storage/'.$bom->gambar_bom) }}" alt="" class="img-fluid">
        </div>

    </div>
@endsection
