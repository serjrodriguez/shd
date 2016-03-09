@extends('admin.admin_index')

@section('title', 'Asignar Tarea')

@section('title2', 'Seleccione el/los usuarios a los que desea asignar esta tarea')

@section('content')

	<script>

		jQuery(document).ready(function(){
			jQuery(".chosen").chosen();
		});

	</script>
	
	{!! Form::open(['route' => ['admin.tareas.saveasign', $tarea], 'method'=>'POST']) !!}
	{{-- <table class="table table-striped"> --}}

	<div class="form-group">
	<select data-placeholder="Selecciona a los empleados a los cuales deseas asignar esta tarea" class="chosen" multiple="true" name="id_usuario[]" id="id_usuario[]" style="width: 100%;">
		@foreach($usuarios as $usuario)
		<option value='{{$usuario->id}}'>{{$usuario->name}}</option>
		@endforeach
	</select>
	</div> <br>

	

	

{{-- 		<thead>
			<th>Asignar</th>
			<th>Nombre completo</th>
			<th>Categoria</th>
			<th>Numero de nomina</th>
		</thead>
		<tbody>
			@foreach($usuarios as $usuario)
				<tr>
					<td>{!! Form::checkbox('id_usuario[]', $usuario->id) !!}</td>
					<td>{{ $usuario->name }}</td>
					<td>
						
						@if($usuario->type == "administrador")
							<span class="label label-danger">{{ $usuario->type }}</span>
						@else
							<span class="label label-primary">{{ $usuario->type }}</span>
						@endif
					</td>
					<td>{{ $usuario->numero_nomina }}</td>
				</tr>
			@endforeach
		</tbody>
	</table> --}}
	<div class="form-group">
		{!! Form::submit('Asignar tarea', ['class' => 'btn btn-primary btn-sm']) !!}
		<a href="{{ route('admin.tareas.index') }}" class="btn btn-info btn-sm">Volver al listado de tareas</a>
	</div>
	{!! Form::close() !!}
	{!! $usuarios->render() !!}

@endsection