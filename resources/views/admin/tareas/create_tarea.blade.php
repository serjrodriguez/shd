@extends('admin.admin_index')

@section('title', 'Crear nueva tarea')

@section('title2', 'Registrar nueva tarea')

@section('content')

		@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					@foreach($errors->all() as $error)
						<li> {{ $error }} </li>
					@endforeach
				</ul>
			</div>
		@endif

		
		{!! Form::open(['route'=>'admin.tareas.store', 'method' => 'POST']) !!}
		
		<div class="form-group">
		{!! Form::label('nombre_tarea', 'Nombre Tarea')!!}
		{!! Form::text('nombre_tarea', null, ['class' => 'form-control', 'placeholder' => 'Nombre de la tarea' ,'required']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('prioridad_tarea', 'Prioridad de la tarea')!!}
		{!! Form::select('prioridad_tarea', ['alta' => 'Alta', 'media' => 'Media', 'baja' => 'Baja'], 'baja', ['class' => 'form-control', 'required']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('status_tarea', 'Status de la tarea')!!}
		{!! Form::select('status_tarea', ['pendiente' => 'Pendiente'], 'pendiente', ['class' => 'form-control', 'required']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('descripcion_tarea', 'Descripcion')!!}
		{!! Form::textarea('descripcion_tarea', null, ['class' => 'form-control', 'placeholder' => 'Agrega una descripcion...']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('fecha_inicio', 'Fecha de inicio')!!}
		{!! Form::date('fecha_inicio', \Carbon\Carbon::now()->setLocale('es')) !!}
		</div>

		<div class="form-group">
		{!! Form::label('fecha_limite', 'Fecha limite')!!}
		{!! Form::date('fecha_limite', \Carbon\Carbon::now()->setLocale('es')) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Crear Tarea', ['class' => 'btn btn-primary btn-sm']) !!}
		

		{!! Form::close() !!}

		<a href="{{ route('admin.tareas.index') }}" class="btn btn-info btn-sm">Volver al listado de tareas</a><br><br>

		</div>

@endsection