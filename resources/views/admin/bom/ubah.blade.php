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
                        <li class="breadcrumb-item"><a href="{{route('bom.index') }}" class="breadcrumb-link">Bill Of Material</a></li>
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
    <!-- data table  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Ubah Bill Of Material</h5>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    
                    <table>
                        <tr>
                            <td>
                                Id BOM
                            </td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $bom->id_bom }}</td>
                        </tr>

                        <tr>
                            <td>
                                Nama Produk
                            </td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $bom->nama_produk }}</td>
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
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                            @foreach ($detail as $no => $bm)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $bm->id_bahan_baku }}</td>
                                    {{-- <td>{{ $bm->nama_produk }}</td> --}}
                                    <td>{{ $bm->nama_bahan_baku }}</td>
                                    <td>{{ $bm->jumlah_bahan }}</td>
                                    <td>
                                    <a href="{{route('detailbom.edit',[$bm->id_detail_bom])}}" class="badge badge-pill badge-warning">Ubah</a>
                                    <a href="{{route('detailbom.hapus',[$bm->id_detail_bom])}}" class="badge badge-pill badge-danger">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>



                </div>
            </div>
            <div class="col-sm-6 pl-0">
                <p class="text-center">
                    {{-- <button type="submit" class="btn btn-primary">Ubah</button> --}}
                    <a type="button" class="btn btn-space btn-secondary"
                        href="{{ route('bom.index') }}">Kembali</a>
                </p>
            </div>
        </div>

    </div>

</div>



@endsection