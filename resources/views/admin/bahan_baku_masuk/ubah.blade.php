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
    <!-- data table  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Ubah Bahan Baku Masuk</h5>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    
                    <table>
                        <tr>
                            <td>
                                Id Transaksi Masuk
                            </td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $bahan->id_transaksi_masuk }}</td>
                        </tr>

                        <tr>
                            <td>
                                Tanggal Masuk
                            </td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $bahan->tanggal_masuk }}</td>
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
                                <th scope="col">Jumlah Masuk</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                            @foreach ($detail as $no => $trsm)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $trsm->id_bahan_baku }}</td>
                                    <td>{{ $trsm->nama_bahan_baku }}</td>
                                    <td>{{ $trsm->jumlah_masuk }}</td>
                                    <td>
                                    <a href="{{route('detailbahanbakumasuk.edit',[$trsm->id_detail_bahan_baku_masuk])}}" class="badge badge-pill badge-warning">Ubah</a>
                                    <a href="{{route('detailbahanbakumasuk.hapus',[$trsm->id_detail_bahan_baku_masuk])}}" class="badge badge-pill badge-danger">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>

                        <tfoot>
                            {{-- <tr>
                                <th>No.</th>
                                <th>Id Bahan Baku</th>
                                <th>Nama Bahan Baku</th>
                                <th>Stok Masuk</th>
                            </tr> --}}
                         
                        </tfoot>
                    </table>



                </div>
            </div>
            <div class="col-sm-6 pl-0">
                <p class="text-center">
                    {{-- <button type="submit" class="btn btn-primary">Ubah</button> --}}
                    <a type="button" class="btn btn-space btn-secondary"
                        href="{{ route('bahan_baku_masuk.index') }}">Kembali</a>
                </p>
            </div>
        </div>

    </div>

</div>



@endsection