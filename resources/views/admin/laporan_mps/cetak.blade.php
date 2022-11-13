<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Master Production Schedule</title>
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
        <h4 class="text-center mt-2 mb-2">LAPORAN MASTER PRODUCTION SCHEDULE</h4>

    </center>

    <div class="card-body">
        <div class="table-responsive">
            <table>
                <tr>
                    <td>
                        Id MPS
                    </td>
                    <td>&nbsp;:&nbsp;</td>
                    <td>{{ $pesanan->id_mps }}</td>
                </tr>

                <tr>
                    <td>
                        Nama Produk
                    </td>
                    <td>&nbsp;:&nbsp;</td>
                    <td>{{ $pesanan->nama_produk }}</td>
                </tr>
            </table>

            <br>

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
                                Id Pesanan
                            </th>
                            <th align="center">
                                Jumlah Pesanan
                            </th>
                            <th align="center">
                                Jadwal Produksi
                            </th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($detail as $no => $mp)
                            <tr>

                                <td align="center">{{ $loop->iteration }}</td>
                                <td align="center">{{ $mp->id_pesanan }}</td>
                                <td align="center">{{ $mp->jumlah_pesanan }}</td>
                                <td align="center">{{ $mp->jadwal_detail_produksi }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>




</body>

</html>
