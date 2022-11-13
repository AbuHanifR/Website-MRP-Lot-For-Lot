@extends('admin.main')
@section('content')

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Dashboard</h2>
            <p class="pageheader-text"></p>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- ============================================================== -->
    <!-- sales  -->
    <!-- ============================================================== -->
    {{-- <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">Total Supplier</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1">{{$ttlsupplier}}</h1>
                </div>
                
            </div>
        </div>
    </div> --}}
    <!-- ============================================================== -->
    <!-- end sales  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- new customer  -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">Total Transaksi Masuk</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1">{{$transaksim}}</h1>
                </div>
                {{-- <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                    <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">10%</span>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end new customer  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- visitor  -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">Total Transaksi Keluar</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1">{{$transaksik}}</h1>
                </div>
                
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end visitor  -->
    <!-- ============================================================== -->
   
</div>

<div class="row">
<div class="col-lg-6 mb-4">
    <div class="card">
        <div class="card-header">
            <!-- <div class="float-right">
                    <select class="custom-select">
                        <option selected>Today</option>
                        <option value="1">Weekly</option>
                        <option value="2">Monthly</option>
                        <option value="3">Yearly</option>
                    </select>
                </div> -->
            <h5 class="mb-0">Transaksi Masuk</h5>
        </div>
        <div class="card-body">
            {{-- <div class="ct-chart-product ct-golden-section"></div> --}}
            <div class="chart">
                <!-- Chart wrapper -->
                <canvas id="myChart" width="400" height="400"></canvas>
                {{-- <canvas id="chart-sales-dark" class="chart-canvas"></canvas> --}}
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6 mb-4">
    <div class="card">
        <div class="card-header">
            <!-- <div class="float-right">
                    <select class="custom-select">
                        <option selected>Today</option>
                        <option value="1">Weekly</option>
                        <option value="2">Monthly</option>
                        <option value="3">Yearly</option>
                    </select>
                </div> -->
            <h5 class="mb-0">Transaksi Keluar</h5>
        </div>
        <div class="card-body">
            <div class="chart">
                <!-- Chart wrapper -->
                <canvas id="myChart2" width="400" height="400"></canvas>
                {{-- <canvas id="chart-sales-dark" class="chart-canvas"></canvas> --}}
            </div>
        </div>
    </div>
</div>

</div>

@endsection

@section('script')
    <script>
        $.ajax({
            url: "/dashboardchart1",
            method: "GET",
            datatype: "json",
            success: function(rtnData) {
                console.log(rtnData)
                $.each(rtnData, function(datatype, data) {
                        console.log(rtnData);
                        var hello = [];
                        var total = [];
                        rtnData['pemasukan'].forEach(res => {
                            var tgl = monthName(res.month);
                            hello.push(tgl);
                            total.push(res.data);
                        });
                        var ctx = document.getElementById("myChart").getContext("2d");
                        config = {
                            type: 'bar',
                            data: {
                                labels: hello,
                                datasets: [{
                                    label: 'Jumlah Transaksi Masuk',
                                    data: total,
                                    backgroundColor: [
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        // ticks: {
                                        //     beginAtZero: true
                                        //     callback: function(value, index, values) {
                                        //         return addCommas(
                                        //             value
                                        //         ); //! panggil function addComas tadi disini
                                        //     }
                                        // }
                                    }]
                                },
                                // tooltips: {
                                //     callbacks: {
                                //         label: function(tooltipItem) {
                                //             return 'Jumlah Transaksi Masuk: ' + addCommas(tooltipItem
                                //                 .yLabel);
                                //         }
                                //     }
                                // }
                            }
                        };
                        chartku = new Chart(ctx, config);
                        window.myPie = chartku1;
                    }

                )
            }
        });

        $.ajax({
            url: "/dashboardchart2",
            method: "GET",
            datatype: "json",
            success: function(rtnData) {
                $.each(rtnData, function(datatype, data) {
                        console.log(rtnData);
                        var hello = [];
                        var total = [];
                        rtnData['pengeluaran'].forEach(res => {
                            var tgl = monthName(res.month);
                            hello.push(tgl);
                            total.push(res.data);
                        });
                        var ctx = document.getElementById("myChart2").getContext("2d");
                        config = {
                            type: 'bar',
                            data: {
                                labels: hello,
                                datasets: [{
                                    label: 'Jumlah Transaksi Keluar',
                                    data: total,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            callback: function(value, index, values) {
                                                return addCommas(
                                                    value
                                                ); //! panggil function addComas tadi disini
                                            }
                                        }
                                    }]
                                },
                                tooltips: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return 'Jumlah Pengeluaran: ' + addCommas(tooltipItem
                                                .yLabel);
                                        }
                                    }
                                }
                            }
                        };
                        chartku2 = new Chart(ctx, config);
                        window.myPie = chartku2;
                    }

                )
            }
        });

        function monthName(mon) {
            return ['Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                ]
                [mon - 1];
        }
       

    </script>
@endsection