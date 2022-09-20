<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Jobick : Job Admin Bootstrap 5 Template" />
	<meta property="og:title" content="Jobick : Job Admin Bootstrap 5 Template" />
	<meta property="og:description" content="Jobick : Job Admin Bootstrap 5 Template" />
	<meta property="og:image" content="https://jobick.dexignlab.com/xhtml/social-image.png" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- PAGE TITLE HERE -->
	<title>Jobick Job Admin</title>
	
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png" />
    <link href="{{asset('base/css/style.css')}}" rel="stylesheet">
	@include('sweetalert::alert')
    @livewireStyles
</head>

<body class="vh-100">
    {{$slot}}
     <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('base/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('base/js/custom.min.js')}}"></script>
    <script src="{{asset('base/js/dlabnav-init.js')}}"></script>
	<script src="{{asset('base/js/styleSwitcher.js')}}"></script>
    @livewireScripts
</body>
</html>
