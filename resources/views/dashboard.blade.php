@extends('layouts.app')

@section('content')

<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <!-- Title and description -->
    <title>EcoWise</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    
    <!-- Favicons -->
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon.png') }}">
    
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
 
</head>

<body>

<!-- Header -->
<header id="header" class="header fixed-top d-flex align-items-center" style="padding-left:0px; height:60px;">
    <!-- Logo and title -->
    <div class="d-flex top-header" style="width:100%; padding-top:20px;">
        <a href="/" class="logo" style="display:inline;">
            <img src="/assets/img/logo.png" alt="">
            <span class=""><strong>EcoWise</strong></span>
        </a>
    </div>
</header>
<!-- End Header -->

<main id="main" class="main">

    <!-- Page Title -->
    <div class="pagetitle" style="padding-top:20px;"></div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                  
                    <div class="col-xxl-4 col-md-4 col-sm-4" style="border: 1px solid white;">
                        <div class="card info-card sales-card" style="padding-bottom:22px;">
                            <!-- Devices Info -->
                            <div class="card-body">
                                <h5 class="card-title">Devices</h5>
                                <!-- Devices Count -->
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <lord-icon src="https://cdn.lordicon.com/kjtalhau.json" trigger="hover" style="width:250px;height:250px"></lord-icon>
                                    </div>
                                    <div class="ps-3"><h6 id="Device">{{ $deviceData['deviceNumber'] }}</h6></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-md col-sm-4">
                        <div class="card info-card customers-card" style="padding-bottom:0px;">
                            <!-- Energy Generated Info -->
                            <div class="card-body">
                                <h5 class="card-title text-danger">Energy Generated</h5>
                                <!-- Energy Data -->
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-lightning"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 id="total-ener">{{ $deviceData['totalEnergy'] }}<sub>kWh</sub></h6>
                                        <span class="text-danger small pt-1 fw-bold" id="energy-incr">{{ $deviceData['energyIncrease'] }}%</span>
                                    </div>
                                </div>
                                <!-- Energy Conversion -->
                                <div class="device-info-footer"><i>(1000kWh = 1MWh)</i></div>
                            </div>
                        </div>
                    </div>

                 
                    <div class="col-xxl-4 col-md col-sm-4">
                        <div class="card info-card revenue-card" style="padding-bottom:0px; color:#198754">
                            <!-- Credit Info -->
                            <div class="card-body">
                                <h5 class="card-title" style="color:#198754">Credit</h5>
                                <!-- Credit Data -->
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <lord-icon src="https://cdn.lordicon.com/jtiihjyw.json" trigger="hover" style="width:250px;height:250px"></lord-icon>
                                    </div>
                                    <div class="ps-3">
                                        <h6 id="total-car-cre">{{ $deviceData['carbonCredit'] }}<sub>c</sub></h6>
                                        <span class="text-success small pt-1 fw-bold" id="carbon-incr" style="color:#198754">{{ $deviceData['energyIncrease'] }}%</span>
                                    </div>
                                </div>
                                <!-- Credit Conversion -->
                                <div class="device-info-footer"><i>(0.5c = 1Kwh)</i></div>
                            </div>
                        </div>
                    </div>

                    <!-- Device Data Table -->
                    <section>
                        <div>
                            <!-- Recent Sales -->
                            <div class="col-15">
                                <div class="card recent-sales overflow-auto">
                                    <div class="card-body">
                                        <table class="table table-responsive">
                                            <thead>
                                                <tr class="dash-table-header">
                                                    <th scope="col">#</th>
                                                    <th>DEVICE ID</th>
                                                    <th scope="col">LOCATION</th>
                                                    <th scope="col">LAST SEEN</th>
                                                    <th scope="col" class="" id="cumm-ener-head">CUMULATIVE ENERGY(kWh)</th>
                                                    <th scope="col">CREDIT (c)</th>
                                                    <th scope="col">BOX STATUS</th>
                                                    <th scope="col">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Device Data Rows -->
                                                <tr class="dash-font">
                                                    <td scope="row"><a id="s-n">1</a></td>
                                                    <td id="dev-id">{{ $deviceData['deviceId'] }}</td>
                                                    <td id="location"></td>
                                                    <td id="last-seen">{{ $deviceData['lastSeen'] }}</td>
                                                    <td id="cumm-ener" class="text-danger">{{ $deviceData['totalEnergy'] }}</td>
                                                    <td id="car-cre" class="car-cre">{{ $deviceData['carbonCredit'] }}</td>
                                                    <td id="box-stat">{{ $deviceData['boxStatus'] }}</td>
                                                    <td><a class="btn btn-success" style="padding:0px; background-color:#012970; padding-left:5px; padding-right:5px;" href="/devices/{{$deviceData['deviceId']}}"> view device</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- End Recent Sales -->
                        </div>
                    </section>
    
                    <!-- Additional Sections -->
                    <section class="section">
                        <div class="row">
                            <!-- Energy Output Graph -->
                            <!-- <div class="col-lg-6 hidden">
                                <div class="card">
                                    <div class="card-body line-body" id="card-body" style="padding:10px; height:500px;">
                                        <h5 class="card-title">Energy Output Graph</h5>
                                        <canvas id="lineChart" style=" height="400"></canvas>
                                    </div>
                                </div>
                            </div> -->

                            <!-- Location of Devices Map -->
                            <div class="col-lg-6">
                                <div class="card" id="map_body" style="height:440px;">
                                    <div class="card">
                                        <div class="card-body" style="padding:10px;">
                                            <h5 class="card-title">Location of Devices</h5>
                                            <!-- Map Placeholder -->
                                            <div class="content" id="default_map" style="height:440px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<!-- Footer -->
<footer id="footer" class="footer">
    <div class="credits">
        <!-- Footer Credits -->
        <a href="#">Innov8 Hub; Impact Lab; Software Unit<script src="https://cdn.lordicon.com/lordicon-1.2.0.js"></script>
            <lord-icon src="https://cdn.lordicon.com/wswofzsi.json" trigger="hover" style="width:30px;height:30px"></lord-icon>
        </a>
    </div>
</footer><!-- End Footer -->

<!-- Back to Top Button -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('/assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('/assets/js/main.js') }}"></script>
<!-- Map JS File -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMaps" async defer></script>
<!-- Template Main JS File -->
</body>
</html>

@endsection

