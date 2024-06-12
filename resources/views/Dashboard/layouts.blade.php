<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard Forecasting</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{ asset('dashboard-css/styles.css') }}" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/c1c447b7e0.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        {{-- Ini adalah navbbar untuk dashboard --}}
        <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #12455B">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/dashboard">UMKM Konveksi</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

            <ul class="navbar-nav d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            {{-- <a class="dropdown-item" href="/">Logout</a> --}}
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        {{-- Ini adalah bagian untuk setting sidebar --}}
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="/dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Data Aktual
                            </a>
                            <div class="sb-sidenav-menu-heading">Forecasting</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Data
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/kategori">Tambah Kategori</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/perhitungan">Perhitungan</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ Auth::user()->name }}
                    </div>
                </nav>
            </div>
            @yield('pages')
        </div>
        <script src="{{ asset('bootstrap-5.3.3/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script>
        <script src="{{ asset('dashboard-js/scripts.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('dashboard-chart/chart-area-demo.js') }}"></script>
        <script src="{{ asset('dashboard-chart/chart-bar-demo.js') }}"></script>
        <script src="{{ asset('dashboard-chart/chart-pie-demo.js') }}"></script>
        {{-- <script>
            function getData(){
                $.ajax({
                    url: '/get-data',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {

                    const bulan = data.map(item => item.bulan);
                    const jumlah = data.map(item => item.jumlah);

                    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                    Chart.defaults.global.defaultFontColor = "#292b2c";

                    // Bar Chart Example
                    var ctx = document.getElementById("myBarChartPenjualan");
                    var myLineChart = new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: bulan,
                            datasets: [
                                {
                                    label: "Revenue",
                                    backgroundColor: "rgba(2,117,216,1)",
                                    borderColor: "rgba(2,117,216,1)",
                                    data: jumlah,
                                },
                            ],
                        },
                        options: {
                            scales: {
                                xAxes: [
                                    {
                                        time: {
                                            unit: "month",
                                        },
                                        gridLines: {
                                            display: false,
                                        },
                                        ticks: {
                                            maxTicksLimit: 6,
                                        },
                                    },
                                ],
                                yAxes: [
                                    {
                                        ticks: {
                                            min: 0,
                                            max: 200,
                                            maxTicksLimit: 5,
                                        },
                                        gridLines: {
                                            display: true,
                                        },
                                    },
                                ],
                            },
                            legend: {
                                display: false,
                            },
                        },
                    });
                        }
                    })
            }
        </script> --}}
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('dashboard-js/datatables-simple-demo.js') }}"></script>
    </body>
</html>
