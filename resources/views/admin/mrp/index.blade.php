@extends('admin.main')
@section('content')

<div class="row">
    <div class="col-md-12">
        @if(session()->has('message'))
        <div class="alert alert-danger">
            {{session('message')}}
        </div>
        @endif
    </div>
</div>


<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Material Requirement Planning</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="breadcrumb-link">Material Requirement Planning</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Material Requirement Planning</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- ============================================================== -->
    <!-- basic table  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="container">
                <div class="row">
                    <h3 class="card-header m-4 text-left">Material Requirement Planning</h3>
                    {{-- <div class="col text-right m-4">
                        <a href="{{route('mrp.create') }}" class="btn btn-primary mb-1">Tambah MRP</a>
                    </div> --}}
                </div>
            </div>




            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Hitung MRP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mrp as $no => $mr)
                            <tr>
                                <td>{{ $mrp->firstItem()+$no}}</td>
                                <td>{{ $mr->nama_produk}}</td>
                                {{-- <td>{{ $mp->nama_produk}}</td>
                                <td>{{ $mp->bulan}}</td>
                                <td>{{ $mp->minggu_1}}</td>
                                <td>{{ $mp->minggu_2}}</td>
                                <td>{{ $mp->minggu_3}}</td>
                                <td>{{ $mp->minggu_4}}</td> --}}
                                
                                <td>
                                    <a href="mrp/hitung/{{$mr->id_mrp}}" class="badge badge-pill badge-primary">Hitung</a>
                                    {{-- <a href="bom/edit/{{ $bm->id_bom}}" class="badge badge-pill badge-warning">Ubah</a>
                                    <a href="bom/destroy/{{ $bm->id_bom}}" class="badge badge-pill badge-danger">Hapus</a> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        {{-- <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Nama Produk</th>
                                <th>Lihat MRP</th>
                            </tr>
                        </tfoot> --}}
                    </table>
                    <br>
                    {{-- <div>
                        Showing
                        {{ $mps->firstItem()}}
                        of
                        {{ $mps->lastItem()}}
                    </div>
                    <div class="pull-right">
                        {{ $mps->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection