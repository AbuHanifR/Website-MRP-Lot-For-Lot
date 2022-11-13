<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Perencanaan Kebutuhan Bahan Baku Per Pesanan</title>
    {{-- <link href="{{ asset('admin/css/bootstrap.css') }}" rel="stylesheet"> --}}

    <style>
        /* body {
            font-family: arial;
        } */

        .print {
            margin-top: 10px;
        }

        @media print {
            .print {
                display: none;
            }
        }

        /* table {
            border-collapse: collapse;
        } */

    </style>
</head>

<body>
    <center>

        <h3 class="text-center mt-2 mb-2">CV. DENY ALUMINIUM</h3>
        <p class="text-center mt-2 mb-2">Jl. Ketabang Magersari Gang 1 No.28, Kec. Genteng, Kota Surabaya, Jawa Timur</p>
        <p class="text-center mt-2 mb-2">No. Telepon: 085850757026 | Email: denyndra.26@gmail.com</p>
        <hr style="border: 2;">
        <h4 class="text-center mt-2 mb-2">Laporan Perencanaan Kebutuhan Bahan Baku Per Pesanan</h4>
        <h4 class="text-center mt-2 mb-2">Produk : {{ $produk_cetak->nama_produk }} Tahun {{ $year }}</h4>

    </center>

    <div class="card-body">
        <div class="table-responsive">
            

            
            {{-- <br>
            <br>
            <br>
            <p><b>DAFTAR BAHAN BAKU:</b></p> --}}

            <div class="table-responsive">
                <table border="1" cellspacing="" cellpadding="4" width="100%">
                    <thead>
                        <tr>
                            <th align="center">
                                No
                            </th>
                            <th align="center">
                                Nama Bahan Baku
                            </th>
                            <th align="center">
                                Jumlah Bahan Baku
                            </th>
                            <th align="center">
                                Satuan
                            </th>
                            <th align="center">
                                Tanggal
                            </th>
                            <th align="center">
                                Minggu Di Butuhkan
                            </th>
                            <th align="center">
                                Minggu Di Pesan
                            </th>
                            <th align="center">
                                Keterangan
                            </th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($laporan as $no => $lpn)
                                    <tr>
                                        <td align="center">{{ $loop->iteration }}</td>
                                        <td align="center">{{ $lpn->nama_bahan_baku }}</td>
                                        <td align="center">{{ $lpn->jumlah_bahan * $lpn->jumlah_pesanan }}</td>
                                        <td>{{ $lpn->satuan }}</td>
                                        <td align="center">{{ $lpn->jadwal_produksi }}</td>
                                        
                                        <td align="center">
                                        @php
                                             $tanggal = date('d', strtotime($lpn->jadwal_produksi));
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
                                        {{$hasil}}
                                        </td>
                                        <td align="center"> 
                                            @php
                                                 $tanggal_dibutuhkan = date('d', strtotime($lpn->jadwal_produksi));
                                                        if ($tanggal_dibutuhkan >= 1 && $tanggal_dibutuhkan <= 7) {
                                                            $hasil_dibutuhkan = 'minggu_0';
                                                        } elseif ($tanggal_dibutuhkan >= 8 && $tanggal_dibutuhkan <= 14) {
                                                            $hasil_dibutuhkan = 'minggu_1';
                                                        } elseif ($tanggal_dibutuhkan >= 15 && $tanggal_dibutuhkan <= 21) {
                                                            $hasil_dibutuhkan = 'minggu_2';
                                                        } elseif ($tanggal_dibutuhkan >= 22 && $tanggal_dibutuhkan <= 31) {
                                                            $hasil_dibutuhkan = 'minggu_3';
                                                        }
                                            @endphp
                                            {{$hasil_dibutuhkan}}
                                            </td>
                                            <td></td>

                                        
                                    </tr>
                                @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>




</body>

</html>
