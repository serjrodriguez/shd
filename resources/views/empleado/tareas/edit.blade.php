@extends('empleado.index')

@section('title', 'Editar Tarea')

@section('title2', 'Editar la tarea ' .$tarea->nombre_tarea)

@section('content')

		
		{!! Form::open(['route'=>['members.tareas.updatemembers', $tarea], 'method' => 'PUT']) !!}
		
		<div class="form-group">
		{!! Form::label('nombre_tarea', 'Nombre Tarea')!!}
		{!! Form::text('nombre_tarea',  $tarea->nombre_tarea, ['class' => 'form-control', 'placeholder' => 'Nombre de la tarea' ,'readonly']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('prioridad_tarea', 'Prioridad de la tarea')!!}
		{!! Form::text('prioridad_tarea', $tarea->prioridad_tarea, ['class' => 'form-control', 'readonly']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('status_tarea', 'Status de la tarea')!!}
		{!! Form::text('status_tarea', $tarea->status_tarea, ['class' => 'form-control', 'required']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('descripcion_tarea', 'Descripcion')!!}
		{!! Form::textarea('descripcion_tarea', $tarea->descripcion_tarea, ['class' => 'form-control', 'placeholder' => 'Esta es una descripcion', 'readonly']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('fecha_inicio', 'Fecha de inicio')!!} <br>
		{!! Form::label('fecha_inicio',  \Carbon\Carbon::parse($tarea->fecha_inicio)) !!}
		</div>

		<div class="form-group">
		{!! Form::label('fecha_limite', 'Fecha limite')!!} <br>
		{!! Form::label('fecha_limite', \Carbon\Carbon::parse($tarea->fecha_limite)) !!}
		</div>

		<div class="form-group">
		{!! Form::label('fecha_fin', 'Fecha finalizacion')!!} <br>
		{!! Form::date('fecha_fin', \Carbon\Carbon::parse($tarea->fecha_limite)) !!}
		</div>

		<div class="form-group" style="text-align: right;">
			{!! Form::submit('Actualizar Tarea', ['class' => 'btn btn-primary btn-sm']) !!}
			{!! Form::close() !!}
		<a href="{{ route('admin.tareas.index') }}" class="btn btn-info btn-sm">Volver al listado de tareas</a><br><br>
		</div>

@endsection