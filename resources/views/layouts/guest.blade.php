<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Pinel Admin - Login" />
	<meta property="og:title" content="Pinel Admin - Login" />
	<meta property="og:description" content="Pinel Admin - Login" />
	<meta property="og:image" content="#" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- PAGE TITLE HERE -->
	<title>Admin Panel</title>
	
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png" />
    <link href="{{asset('base/css/style.css')}}" rel="stylesheet">

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
