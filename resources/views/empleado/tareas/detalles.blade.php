@extends('empleado.index')

@section('title', 'Detalles Tarea')

@section('title2', 'Tarea '.$tarea->nombre_tarea)

@section('content')

	<div class="panel panel-default">
  		<div class="panel-heading"><span class="glyphicon glyphicon-file"></span>&nbsp;&nbsp;Detalles de la tarea</div>
  			<div class="panel-body">

    			ID: {{ $tarea->id }} <br><br>
    			Nombre: {{$tarea->nombre_tarea}} <br><br>
    			Descripcion: {{ $tarea->descripcion_tarea }} <br><br>
    			Prioridad: {{ $tarea->prioridad_tarea }} <br><br>
    			Status: {{ $tarea->status_tarea }} <br><br>
    			Fecha de inicio: {{ $tarea->fecha_inicio }} <br><br>
    			Fecha limite: {{ $tarea->fecha_limite }} <br><br>
          @if($tarea->fecha_fin == '30-11--0001' )
          <p>Esta tarea aun no ha sido finalizada</p>
          @else
          Fecha finalizacion: {{ $tarea->fecha_fin }} <br><br>
          @endif

			<div style="text-align: right;">
      <a href="{{ route('members.tareas.index') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-chevron-left"></span>Volver al listado de tareas</a>
			<a href="{{ route('members.tareas.editmembers', $tarea->id) }}" class="btn btn-info btn-sm">Editar Tarea&nbsp;<span class="glyphicon glyphicon-pencil"></span></a>
      <a href="{{ route('members.tareas.generaPDF', $tarea->id) }}" class="btn btn-warning btn-sm" target="_blank">Imprimir PDF&nbsp;<span class="glyphicon glyphicon-paperclip"></span></a>
			</div>

  			</div>
	</div>

@endsection