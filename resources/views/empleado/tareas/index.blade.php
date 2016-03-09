@extends('empleado.index')

@section('content')
		<?php
		$i = 0;
		?>

		<table class="table table-striped">
					<thead>
						<th>Tarea</th>
						<th>Prioridad</th>
						<th>Status Tarea</th>
						<th>Opciones</th>
		</thead>

		@foreach($tareas as $tarea)
			@if($tarea->id_empleado != Auth::user()->id)
			@else
				<?php
					$i = $i+1;
				?>
				<tbody>
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
						<a href="{{ route('members.tareas.detalles', $tarea->id) }}" class="btn btn-info btn-xs">Ver detalles</a>
						</td>
					</tr>
			@endif
		@endforeach
		<?php
			
			if ($i == 0) {
				echo "No tienes tareas pendientes.";
			}

		?>
		</tbody>
	</table>
@endsection