<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="{{ asset('favicon_128x128.ico') }}" type="image/x-icon">
	<script src="{{ asset('jquery/jquery-2.2.0.js')}}"></script>
	<script src="{{ asset('jquery/jquery-2.2.0.min.js') }}"></script>
	<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('metro/select2/dist/js/select2.js') }}"></script>
	<script src="{{ asset('Highcharts-4.2.1/js/highcharts.js') }}"></script>
	<script src="{{ asset('chosen/chosen.jquery.js') }}"></script>
	@yield('importjs', '')
	<link rel="stylesheet" href="{{ asset('metro/select2/dist/css/select2.css') }}">
	<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
	<link rel="stylesheet" href="{{ asset('chosen/chosen.css') }}">
	@yield('importcss')
	<title>@yield('title','Default') | Panel de Administracion|</title>
	
</head>
<body>
	
	@include('admin.partials.nav_admin')

	<section>
		<div class="panel panel-default">
			<div class="panel-heading">@yield('title2', 'Default')</div>
				<div class="panel-body">
					@include('flash::message')
				    @yield('content', 'Default')
				</div>
		</div>
	</section>
	@include('admin.partials.footer')

<!--<script>
  $(document).on('ready', function(){
    $('.dropdown-toggle').dropdown()
  })
</script>-->
  	
</body>
</html>