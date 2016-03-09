@extends('admin.admin_index')

@section('title', 'Listado de usuarios')

@section('title2', 'Listado de usuarios')

<!--<script scr="{{ asset('plugins/js/ajaxSearchUser.js') }}"></script>-->



@section('content')

<script>
$(document).on("ready", function() 
{
  	$("#name").keydown
  	( //Evento de presionar una tecla en el campo cuyo id sea "name"
   		function(event)
   			{
    			var param = $("#name").attr("value"); //Se obtiene el valor del campo de texto
    			$("#resultados").load("{{ route('admin.users.index') }}",{name:param}); //Y se envía por vía post al archivo busqueda.php para luego recargar el div con el resultado obtenido
   			}
  	);
});

$(document).on("ready", function() 
{
  $("#name").keyup( //Evento de soltar una tecla en el campo cuyo id sea "name"
   		function(event)
   			{
    			var param = $("#name").attr("value"); //Se obtiene el valor del campo de texto
    			$("#resultados").load("{{ route('admin.users.create') }}",{name:param}); //Y se envía por vía post al archivo busqueda.php para luego recargar el div con el resultado obtenido
   			}
  	);
});
</script>

	<!-- INICIO DEL BUSCADOR -->

		{!! Form::open(['route' => 'admin.users.index', 'method' => 'GET', 'class' => 'navbar-form pull-right', 'id' => 'search_form']) !!}

			<div class="input-group">
				
				{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Buscar usuario...', 'aria-describedby' => 'search']) !!}

				<span class="input-group-addon" id="search">
					<span class="glyphicon glyphicon-search" aria-hidden="true">
					</span>
				</span>

			</div>

		{!! Form::close() !!}

	<!-- FIN DEL BUSCADOR -->

	<a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">Registrar Nuevo Usuario&nbsp;<span class="glyphicon glyphicon-plus"></span></a><br><br>
	<div id="resultados">
	<table class="table table-striped">
		<thead>
			<th>Nombre completo</th>
			<th>Categoria</th>
			<th>Numero de nomina</th>
			<th>Opciones</th>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td>{{ $user->name }}</td>
					<td>
						
						@if($user->type == "administrador")
							<span class="label label-danger">{{ $user->type }}</span>
						@else
							<span class="label label-primary">{{ $user->type }}</span>
						@endif
					</td>
					<td>{{ $user->numero_nomina }}</td>
					<td> 
					<a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-xs">Editar</a>
					<a href="{{ route('admin.users.detalles', $user->id) }}" class="btn btn-info btn-xs">Ver detalles</a>
					<a href="{{ route('admin.users.destroy', $user->id) }}" onclick=" return confirm('¿Seguro que desea eliminar el usuario seleccionado?')" class="btn btn-danger btn-xs">Eliminar</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	</div>
	{!! $users->render() !!}


@endsection