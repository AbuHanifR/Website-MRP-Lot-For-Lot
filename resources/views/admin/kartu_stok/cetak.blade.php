<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kartu Stok Bahan Baku</title>
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
        <h3 class="text-center mt-2 mb-2">Kartu Stok Bahan Baku</h3>

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
                                Tanggal
                            </th>
                            <th align="center">
                                Nama Bahan Baku
                            </th>
                            <th align="center">
                                Masuk
                            </th>
                            <th align="center">
                                Keluar
                            </th>
                            <th align="center">
                                Sisa Stok
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($laporan as $no => $lpn)
                                    <tr align="center">
                                        <td>{{ $lpn->tanggal_masuk }}</td>
                                        <td>{{ $lpn->nama_bahan_baku }}</td>
                                        <td>{{ $lpn->jumlah_masuk }}</td>
                                        <td></td>
                                        <td>{{ $lpn->stok }}</td>
                                        {{-- <td>{{ $lpn->jumlah_masuk + $lpn->stok}}</td> --}}
                                       
                                    </tr>
                                @endforeach

                                @foreach ($laporan2 as $no => $lpn)
                                <tr align="center">
                                    <td>{{ $lpn->tanggal_keluar }}</td>
                                    <td>{{ $lpn->nama_bahan_baku }}</td>
                                    <td></td>
                                    <td>{{ $lpn->jumlah_keluar }}</td>
                                    <td>{{ $lpn->stok }}</td>
                                    {{-- <td>{{$lpn->stok - $lpn->jumlah_keluar}}</td> --}}
                                   
                                </tr>
                            @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>




</body>

</html>
