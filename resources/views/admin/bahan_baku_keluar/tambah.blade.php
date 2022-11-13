@extends('admin.main')
@section('content')
    <!-- Pageheader -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Tambah Bahan Baku Keluar</h2>
                <p class="pageheader-text"></p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="breadcrumb-link">Bahan Baku Keluar</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('bahan_baku_keluar.index') }}"
                                    class="breadcrumb-link">Bahan Baku Keluar</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Bahan Baku Keluar</li>
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
                    <h5 class="card-header">Tambah Bahan Baku Keluar</h5>
                    <div class="card-body">


                        <form action="/bahan_baku_keluar" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-sm-5 col-md-6">
                                    <div class="form-group">
                                        <label for="id_transaksi_keluar">Id Transaksi Keluar</label>
                                        <input type="text" class="form-control" name="id_transaksi_keluar"
                                            placeholder="id_transaksi_keluar" value="{{ $kode }}" readonly>
                                        {!! $errors->first('kode', "<p class='invalid-feedback'>:message</p>") !!}
                                    </div>
                                </div>

                                <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                                    <div
                                        class="form-group {{ $errors->has('tanggal_keluar') ? 'has-error' : 'has-success' }}">
                                        <div class="form-group">
                                            <label for="tanggal_keluar">Tanggal Keluar</label>
                                            <input type="date" class="form-control" name="tanggal_keluar"
                                                value="{{date_format($tanggal, "Y-m-d")}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="row">
                            <div class="col-sm-6 col-md-5 col-lg-6">
                                <div class="form-group">
                                    <label for="nama_penerima">Penerima</label>
                                    <input type="text" class="form-control" name="nama_penerima" placeholder="nama_penerima" value="{{ Auth::user()->name }}" readonly>
                                </div>
                            </div>
                        </div> --}}

                            {{-- <div class="row">
                            <div class="col-sm-6 col-md-5 col-lg-6">
                                <div class="form-group">
                                    <label for="nama_supplier">Nama Supplier</label>
                                    <select class="form-control" id="nama_supplier" name="nama_supplier">
                                        @foreach ($supplier as $supplier)
                                        <option value="{{ $supplier->id_supplier}}">
                                            {{$supplier->nama_supplier}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div> --}}


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
                                        <label for="jumlah_keluar">Jumlah Keluar</label>
                                        <input type="text" class="form-control" name="jumlah_keluar"
                                            placeholder="Jumlah Keluar">
                                    </div>
                                    @error('jumlah_keluar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>



                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-md-5 col-lg-6">
                                    <div class="form-group">
                                        <label for="keperluan">Keperluan</label>
                                        <input type="text" class="form-control" name="keperluan" placeholder="Keperluan">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0">
                                    <div class="form-group">
                                        <label for="satuan">Satuan</label>
                                        <input id="satuan" type="text" class="form-control" name="satuan"
                                            placeholder="satuan" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary" style="margin-top: 22px;">Tambah</button>
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
                                <p><b>DAFTAR BAHAN BAKU:</b></p>
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width:10px;">No.</th>
                                            <th>Id Bahan Baku</th>
                                            <th>Nama Bahan Baku</th>
                                            <th>Jumlah Keluar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($bahan2 as $bhn)
                                            @foreach ($transaksi as $trs)
                                                @if ($bhn->id_bahan_baku == $trs['nama_bahan_baku'])
                                                    @php
                                                        $total -= $trs['jumlah_keluar'];
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $trs['nama_bahan_baku'] }}</td>
                                                        <td>{{ $bhn->nama_bahan_baku }}</td>
                                                        <td>{{ $trs['jumlah_keluar'] }}</td>
                                                        <td> <a href="/bahan_baku_keluar/hapusdata/{{ $trs['nama_bahan_baku'] }}"
                                                                class="badge badge-pill badge-danger">Hapus</a></td>
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
                                            <th>Total Bahan Baku Keluar</th>
                                            <th>{{ $total }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <form action="/bahan_baku_keluar/simpandata" method="POST">
                            @csrf
                            <div class="col-sm-6 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a type="button" class="btn btn-space btn-secondary"
                                        href="{{ route('bahan_baku_keluar.index') }}">Batal</a>
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
