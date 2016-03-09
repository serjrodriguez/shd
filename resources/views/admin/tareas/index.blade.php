@extends('admin.admin_index')

@section('title', 'Listado de tareas')

@section('title2', 'Tareas')

@section('content')

	<!-- INICIO DEL BUSCADOR -->

		{!! Form::open(['route' => 'admin.tareas.index', 'method' => 'GET', 'class' => 'navbar-form pull-right']) !!}

			<div class="input-group">
				
				{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Buscar tarea...', 'aria-describedby' => 'search']) !!}

				<span class="input-group-addon" id="search">
					<span class="glyphicon glyphicon-search" aria-hidden="true">
					</span>
				</span>

			</div>

		{!! Form::close() !!}

	<!-- FIN DEL BUSCADOR -->

	<a href="{{ route('admin.tareas.create') }}" class="btn btn-primary btn-sm">Crear nueva tarea&nbsp;<span class="glyphicon glyphicon-plus"></span></a><br><br>
	<table class="table table-striped">
		<thead>
			<th>Nombre tarea</th>
			<th>Prioridad</th>
			<th>Status</th>
			<th>Opciones</th>
		</thead>
		<tbody>
			@foreach($tareas as $tarea)
				<tr>
					<td>{{ $tarea->nombre_tarea }}</td>
					<td>
						
						@if($tarea->prioridad_tarea == "alta")
							<span class="label label-danger">{{ $tarea->prioridad_tarea }}</span>
						@elseif($tarea->prioridad_tarea == "media")
							<span class="label label-warning">{{ $tarea->prioridad_tarea }}</span>
						@else
							<span class="label label-primary">{{ $tarea->prioridad_tarea }}</span>
						@endif
					</td>
					<td>{{ $tarea->status_tarea }}</td>
					<td> 
					<a href="{{ route('admin.tareas.edit', $tarea->id) }}" class="btn btn-warning btn-xs">Editar</a>
					<a href="{{ route('admin.tareas.detalles', $tarea->id) }}" class="btn btn-info btn-xs">Ver detalles</a>
					<a href="{{ route('admin.tareas.asignar', $tarea->id) }}" class="btn btn-primary btn-xs">Asignar</a>
					<a href="{{ route('admin.tareas.destroy', $tarea->id) }}" onclick=" return confirm('¿Seguro que desea eliminar la tarea seleccionada?')" class="btn btn-danger btn-xs">Eliminar</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $tareas->render() !!}


@endsection