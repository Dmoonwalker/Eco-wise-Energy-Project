@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Title, icon, and meta tags -->
    <link rel="icon" href="{{asset('assets/img/logo.png') }}">
    <title>Ecowise</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/assets/img/favicon.png" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/assets/css/style.css" rel="stylesheet">
</head>

<body>
 
 <!-- Header -->
 <header class="header fixed-top" style="padding-left:20px;">

    <div class="d-flex top-header" style="width:100%; padding-top:20px;">
        <a href="/" class="logo " style="display:inline; ">
            <img src="/assets/img/logo.png" alt="" style="">
            <span class=""><strong>ecoWise</strong></span>
        </a>
    </div>
</header>
<!-- End Header -->

<main class="mainDevice">
    <section class="section">
        <div class="row">
            <!-- Map Section -->
            <div class="col-lg-8 col-sm-12">
                <div class="card" style="height:800px">
                    <div class="card">
                        <div class="device-card-body">
                            <!-- Map Placeholder -->
                            <div class="content" id="default_map" style="height: 800px;"></div>
                        </div>
                    </div>
                </div>
            </div> 

            <!-- Device Information Section -->
            <div class="col-lg-4 col-sm-12" style="padding:0px;">
                <div class="card" style="">
                    <div style="padding-top:20px">
                        <center><img src="/assets/img/sun.gif" alt="" style="width: 70px; height:70px; margin-bottom:25px;">
                            <div class="device-font" style="color:#012970; display:block;  padding:15px; background-color: #E8E8E8;">ecoWise Device 001</div>
                        </center>
                    </div>
                    <div class="card-body">
                        <!-- Device Information Table -->
                        <table class="table table-hover DeviceInfoTable">
                            <tbody class="DeviceInfo my-font">
                                <tr>
                                    <td scope="row">First Seen</td>
                                    <td> {{$DeviceData['FirstSeen']}}</td>
                                </tr>
                                <!-- More device information rows -->
                            </tbody>
                        </table>
                        <!-- Buttons for actions -->
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Download Device Data Button -->
                                <a class="pull-right btn btn-success" style="float:right; background-color:#012970; margin:3px;" id="download"> Download Device Data</a>
                                <!-- Reset Limit Button -->
                                @if(isset($DeviceData['BoxStatus']) && $DeviceData['BoxStatus'] == 'opened')
                                    <a class="pull-right btn btn-danger" style="float:right; margin:3px;" id="resetLimit"> Reset Limit</a>
                                @endif
                                <!-- Reset Device Button -->
                                <a class="pull-right btn btn-success" style="float:right;  margin: 3px;" id="reset"> Reset Device</a>
                            </div>
                            <div class="col-lg-12">
                                <!-- Footer indicating solar-powered device -->
                                <div class="card-footer" style="margin-top:10px">
                                    Solar Powered <img src="/assets/img/flag.png" alt="" style="width: 17px; height:17px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dialogs for confirmation -->
    <dialog id="dialog-1"> <p> Reset this Limit?</p>
        <div>
            <button value="cancel" id="cancel-1" autofocus>Cancel</button>
            <button id="confirm-1" value="default">Confirm</button>
        </div>
    </dialog>
    <dialog id="dialog-2">
        <p> Reset this Device?</p>
        <div>
            <button value="cancel" id="cancel-2" autofocus>Cancel</button>
            <button id="confirm-2" value="default">Confirm</button>
        </div>
    </dialog>
</main><!-- End #main -->

<!-- Back to Top Button -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/jquery-3.7.1.min.js"></script>
<script>
    var latitude =  {{$DeviceData['lat']}};
    var longitude = {{$DeviceData['lng']}};
</script>
<script src="/assets/js/map.js"></script>

<!-- Map JS File -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMaps" async defer></script> 
</body>

</html>
@endsection
