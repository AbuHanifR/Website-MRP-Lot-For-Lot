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
    <div class="col-md-12">
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Master Production Schedule</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="breadcrumb-link">Master Production Schedule</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Master Production Schedule</li>
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
                    <h3 class="card-header m-4 text-left">Daftar Master Production Schedule</h3>
                    <div class="col text-right m-4">
                        <a href="{{route('mps.create') }}" class="btn btn-primary mb-1">Tambah MPS</a>
                    </div>
                </div>
            </div>




            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Id MPS</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Bulan</th>
                                <th scope="col">Minggu 1</th>
                                <th scope="col">Minggu 2</th>
                                <th scope="col">Minggu 3</th>
                                <th scope="col">Minggu 4</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mps as $no => $mp)
                            <tr>
                                <td>{{ $mps->firstItem()+$no}}</td>
                                <td>{{ $mp->id_mps}}</td>
                                <td>{{ $mp->nama_produk}}</td>
                                <td>{{ date('F',strtotime($mp->bulan))}}</td>
                                <td>{{ $mp->minggu_1}}</td>
                                <td>{{ $mp->minggu_2}}</td>
                                <td>{{ $mp->minggu_3}}</td>
                                <td>{{ $mp->minggu_4}}</td>
                                
                                {{-- <td>
                                    <a href="bom/detail/{{ $bm->id_bom}}" class="badge badge-pill badge-primary">Detail</a>
                                    <a href="bom/edit/{{ $bm->id_bom}}" class="badge badge-pill badge-warning">Ubah</a>
                                    <a href="bom/destroy/{{ $bm->id_bom}}" class="badge badge-pill badge-danger">Hapus</a>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <div>
                        Showing
                        {{ $mps->firstItem()}}
                        of
                        {{ $mps->lastItem()}}
                    </div>
                    <div class="pull-right">
                        {{ $mps->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection