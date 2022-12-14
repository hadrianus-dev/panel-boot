<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PANEL</title>
	
    <!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="base/images/favicon.png" />
	<link href="{{asset('base/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
	<link href="{{asset('base/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
	
	<!-- Datatable -->
    <link href="{{asset('base/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
	<!-- Style css -->
    <link href="{{asset('base/css/style.css')}}" rel="stylesheet">
    @livewireStyles
	
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <!--**********************************
        Main wrapper start
        ***********************************-->
    <div id="main-wrapper">
		<livewire:panel.components.nav-header>
		<livewire:panel.components.chatbox>
		<livewire:panel.components.header>
		<livewire:panel.components.sidebar>
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
                {{$slot}}
            </div>
            <!-- end row -->
        </div>
        <!--**********************************
            End Content body start
        ***********************************-->
        <livewire:panel.components.footer>
    </div>

{{-- 	@livewire('panel.category.store-controller') --}}

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('base/vendor/global/global.min.js')}}"></script>
	<script src="{{asset('base/vendor/chart.js/Chart.bundle.min.js')}}"></script>
	<script src="{{asset('base/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>
		
	<!-- Datatable -->
	<script src="{{asset('base/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('base/js/plugins-init/datatables.init.js')}}"></script>

	<!-- Apex Chart -->
	<script src="{{asset('base/vendor/apexchart/apexchart.js')}}"></script>
	
	<script src="{{asset('base/vendor/chart.js/Chart.bundle.min.js')}}"></script>
	
	<!-- Chart piety plugin files -->
    <script src="{{asset('base/vendor/peity/jquery.peity.min.js')}}"></script>
	
	<!-- Dashboard 1 -->
	<script src="{{asset('base/js/dashboard/dashboard-1.js')}}"></script>
	
	<script src="{{asset('base/vendor/owl-carousel/owl.carousel.js')}}"></script>
	
    <script src="{{asset('base/js/custom.min.js')}}"></script>
	<script src="{{asset('base/js/dlabnav-init.js')}}"></script>
	<script src="{{asset('base/vendor/ckeditor/ckeditor.js')}}"></script>
{{-- 	<script src="{{asset('base/js/demo.js')}}"></script> --}}
    <script src="{{asset('base/js/styleSwitcher.js')}}"></script>
	<script>
		jQuery(document).ready(function(){
			setTimeout(function(){
				dlabSettingsOptions.version = 'dark';
				new dlabSettings(dlabSettingsOptions);
			},1500)
		});
		function JobickCarousel()
			{

				/*  testimonial one function by = owl.carousel.js */
				jQuery('.front-view-slider').owlCarousel({
					loop:false,
					margin:30,
					nav:true,
					autoplaySpeed: 3000,
					navSpeed: 3000,
					autoWidth:true,
					paginationSpeed: 3000,
					slideSpeed: 3000,
					smartSpeed: 3000,
					autoplay: false,
					animateOut: 'fadeOut',
					dots:true,
					navText: ['', ''],
					responsive:{
						0:{
							items:1
						},
						
						480:{
							items:1
						},			
						
						767:{
							items:3
						},
						1750:{
							items:3
						}
					}
				})
			}

			jQuery(window).on('load',function(){
				setTimeout(function(){
					JobickCarousel();
				}, 1000); 
			});
	</script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<x-livewire-alert::scripts />
	<script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script> 
	<x-livewire-alert::flash />
    @livewireScripts
</body>
</html>