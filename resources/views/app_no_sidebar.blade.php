<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 app sidebar sidebar-fusion sidebar-kis footer-sticky navbar-sticky"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 app sidebar sidebar-fusion sidebar-kis footer-sticky navbar-sticky"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 app sidebar sidebar-fusion sidebar-kis footer-sticky navbar-sticky"> <![endif]-->
<!--[if gt IE 8]> <html class="ie app sidebar sidebar-fusion sidebar-kis footer-sticky navbar-sticky"> <![endif]-->
<!--[if !IE]><!-->
<html class="app footer-sticky">
<!-- <![endif]-->
	<head>
		<title>Sistema Integral para la Administración del Consultorio Médico</title>

		<!-- Meta -->
		<meta charset="utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />

		<link rel="stylesheet" href="{{ asset('public/assets/css/admin/siacme.css') }}" />
		@yield('css')
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	    <![endif]-->
	    <script>if (/*@cc_on!@*/false && document.documentMode === 10) { document.documentElement.className+=' ie ie10'; }</script>

	</head>
	<body class="scripts-async @yield('loginClass')">
		<!-- Main Container Fluid -->
		<div class="container-fluid menu-hidden">
			<div id="content">
				<div class="layout-app">
					<!-- row -->
					<div class="row row-app">
						<!-- col -->
						<div class="col-md-12">
							<!-- col-separator -->
							<div class="col-separator col-unscrollable box">
								<!-- col-table -->
								<div class="col-table">
									<h4 class="innerAll margin-none border-bottom bg-white text-center">@yield('titulo')</h4>
									<!-- col-table-row -->
									<div class="col-table-row">
										<!-- col-app -->
										<div class="col-app col-unscrollable">
											<div class="col-app">
												@yield('contenido')
											</div>
										</div>
										<!-- // END row -->
									</div>
									<!-- // END col-app -->
								</div>
								<!-- // END col-table-row -->
							</div>
							<!-- // END col-table -->
						</div>
						<!-- // END col-separator -->
					</div>
					<!-- // END col -->
				</div>
				<!-- // END row-app -->
			</div>
		</div>
		<!-- // Content END -->
		<div class="clearfix"></div>

		<script data-id="App.Config">
			var basePath = '',
				commonPath = 'public/assets/',
				rootPath = 'public/',
				DEV = false,
				componentsPath = 'public/assets/components/',
				layoutApp = true,
				module = 'admin';

			var primaryColor = '#BC1818',
				dangerColor = '#b55151',
				successColor = '#609450',
				infoColor = '#4a8bc2',
				warningColor = '#ab7a4b',
				inverseColor = '#45484d';

			var themerPrimaryColor = primaryColor;
		</script>
		<script type="text/javascript" src="{{ asset('public/assets/components/plugins/ajaxify/script.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/library/jquery/jquery.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/library/modernizr/modernizr.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/library/bootstrap/js/bootstrap.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/library/jquery/jquery-migrate.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/plugins/nicescroll/jquery.nicescroll.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/plugins/breakpoints/breakpoints.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/plugins/ajaxify/davis.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/plugins/ajaxify/jquery.lazyjaxdavis.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/plugins/preload/pace/pace.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/plugins/less-js/less.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/plugins/browser/ie/ie.prototype.polyfill.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/modals/assets/js/bootbox.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/core/js/preload.pace.init.js?v=v1.9.6') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/core/js/sidebar.main.init.js?v=v1.9.6') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/core/js/sidebar.collapse.init.js?v=v1.9.6') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/core/js/sidebar.kis.init.js?v=v1.9.6') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/core/js/core.init.js?v=v1.9.6') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/components/core/js/animations.init.js?v=v1.9.6') }}"></script>
		@yield('js')

	</body>
</html>