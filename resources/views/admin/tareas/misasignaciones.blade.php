@extends('admin.admin_index')

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
						<td>{{ $tarea->prioridad_tarea }}</td>
						<td>{{ $tarea->status_tarea }}</td>
						<td> 
						<a href="{{ route('admin.tareas.detalles', $tarea->id) }}" class="btn btn-info btn-xs">Ver detalles</a>
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