<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title','Default') | Panel de Usuarios</title>
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
	<link rel="shortcut icon" href="{{ asset('favicon_128x128.ico') }}" type="image/x-icon">
	@yield('importcss')
</head>
<body>
	
	@include('empleado.partials.nav_user')

	<section>
		<div class="panel panel-default">
			<div class="panel-heading">@yield('title2', 'Tareas Pendientes')</div>
				<div class="panel-body">
					@include('flash::message')
				    @yield('content', 'Default')
				</div>
		</div>
	</section>
	@include('empleado.partials.footer')
	<script scr="{{ asset('plugins/bootstrap-3.3.6-dist/js/bootstrap.js') }}"></script>
  	<script scr="{{ asset('plugins/jquery/jquery-2.2.0.js') }}"></script>
</body>
</html>