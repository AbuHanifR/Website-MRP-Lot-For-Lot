<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Bahan Baku Masuk</title>
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
        <h3 class="text-center mt-2 mb-2">Laporan Bahan Baku Masuk</h3>

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
                                Id Transaksi
                            </th>
                            <th align="center">
                                Nama Bahan Baku
                            </th>
                            <th align="center">
                                Jumlah Masuk
                            </th>
                            <th align="center">
                                Tanggal Masuk
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($laporan as $no => $lpn)
                                    <tr>
                                        <td align="center">{{ $loop->iteration }}</td>
                                        <td align="center">{{ $lpn->id_transaksi_masuk }}</td>
                                        <td align="center">{{ $lpn->nama_bahan_baku }}</td>
                                        <td align="center">{{ $lpn->jumlah_masuk }}</td>
                                        <td align="center">{{ $lpn->tanggal_masuk }}</td>
                                    </tr>
                                @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>




</body>

</html>
