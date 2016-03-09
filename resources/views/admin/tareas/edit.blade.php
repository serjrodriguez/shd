@extends('admin.admin_index')

@section('title', 'Editar Tarea')

@section('title2', 'Editar la tarea ' .$tarea->nombre_tarea)

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

		
		{!! Form::open(['route'=>['admin.tareas.update', $tarea], 'method' => 'PUT']) !!}
		
		<div class="form-group">
		{!! Form::label('nombre_tarea', 'Nombre Tarea')!!}
		{!! Form::text('nombre_tarea',  $tarea->nombre_tarea, ['class' => 'form-control', 'placeholder' => 'Nombre de la tarea' ,'required']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('prioridad_tarea', 'Prioridad de la tarea')!!}
		{!! Form::select('prioridad_tarea', ['alta' => 'Alta', 'media' => 'Media', 'baja' => 'Baja'], $tarea->prioridad_tarea, ['class' => 'form-control', 'required']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('status_tarea', 'Status de la tarea')!!}
		{!! Form::select('status_tarea', ['finalizada' => 'Finalizada', 'pendiente' => 'Pendiente'], $tarea->status_tarea, ['class' => 'form-control', 'required']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('descripcion_tarea', 'Descripcion')!!}
		{!! Form::textarea('descripcion_tarea', $tarea->descripcion_tarea, ['class' => 'form-control', 'placeholder' => 'Esta es una descripcion']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('fecha_inicio', 'Fecha de inicio')!!}
		{!! Form::date('fecha_inicio',  \Carbon\Carbon::parse($tarea->fecha_inicio)) !!}
		</div>

		<div class="form-group">
		{!! Form::label('fecha_limite', 'Fecha limite')!!}
		{!! Form::date('fecha_limite', \Carbon\Carbon::parse($tarea->fecha_limite)) !!}
		</div>

		<div class="form-group">
		{!! Form::label('fecha_fin', 'Fecha fin')!!}
		{!! Form::date('fecha_fin', \Carbon\Carbon::parse($tarea->fecha_fin)) !!}
		</div>

		<div class="form-group"">
			{!! Form::submit('Actualizar Tarea', ['class' => 'btn btn-primary btn-sm']) !!}
			{!! Form::close() !!}
		<a href="{{ route('admin.tareas.index') }}" class="btn btn-info btn-sm">Volver al listado de tareas</a><br><br>
		</div>

@endsection