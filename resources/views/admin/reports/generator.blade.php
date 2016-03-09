<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Generador de reportes</title>
		
	<script type="text/javascript">
	    function showContent() {
	        element = document.getElementById("ocultar");
	        var mitexto = $("#campos option:selected").text()
	        check = document.getElementById("checkbox");

	        if (checkbox.checked) {
	            element.style.display='block';
	        }
	        else 
	        {
	            element.style.display='none';
	        }
	    }

	    function mostrarVentana()
			{
			    document.getElementById('light').style.display='block';
				document.getElementById('fade').style.display='block';
			}

		function ocultarVentana()
			{
			    document.getElementById('light').style.display='none';
				document.getElementById('fade').style.display='none';
			}
	</script>

	<script>
		jQuery(document).ready(function(){
			jQuery(".chosen").chosen();
		});
	</script>
</head>
<body>

	{!! Form::open(['route' => 'admin.reports.genera', 'method' => 'POST']) !!}
		<div class="form-group">
			{!! Form::label('periodo', 'Selecciona el periodo de tiempo con el cual deseas generar el reporte') !!}
			{!! Form::select('periodo', ['dia' => 'Periodo por dia', 'semanal' => 'Periodo semanal', 'mensual' => 'Periodo mensual'], null,['class' => 'form-control', 'placeholder' => 'Selecciona un periodo de tiempo', 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('fecha_inicio', 'Selecciona la fecha inicial') !!}
			{!! Form::date('fecha_inicio', \Carbon\Carbon::now()->setLocale('es'), ['required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('fecha_fin', 'Selecciona la fecha final') !!}
			{!! Form::date('fecha_fin', \Carbon\Carbon::now()->setLocale('es'), ['required']) !!}
		</div>
		</div>

		<div class="form-group">
			{!! Form::label('campos','Selecciona los campos que deseas incluir en el reporte') !!}
			{!! Form::select('campos', ['tareas_finalizadas' => 'Tareas Finalizadas', 'tareas_pendientes' => 'Tareas pendientes', 'tareas_finalizadas_pendientes' => 'Ambas'], 'tareas_finalizadas', ['class' => 'form-control', 'id' => 'campos' ,'required']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::label('opcion_empleado', '¿Deseas generar un reporte sobre algun empleado(s) en especifico?') !!}
			<div class="checkbox">
				<label>{!! Form::checkbox('checkbox', null, true, ['class' => 'checkbox', 'id' => 'checkbox', 'onchange' => 'javascript:showContent()']) !!} Si, Seleccionar empleados</label>
			</div>
		</div>

		<div class="form-group" id="ocultar">
			<div class="form_group">
				{!! Form::label('selecciona_empleado', 'Selecciona los empleados sobre los cuales deseas realizar el reporte') !!}
			</div>
			
			<div class="form-group">
				<select data-placeholder="Selecciona a los empleados" class="chosen empleados-select" multiple="true" style="width: 100%;" name="empleados[]" id="empleados[]">
					@foreach($users as $usuarios)
						<option value="{{$usuarios->id}}">{{$usuarios->name}}</option>
					@endforeach
				</select>
			</div>
		</div>

			{!! Form::submit('Generar Reporte', ['class' => 'btn btn-primary btn-sm']) !!}

	{!! Form::close() !!}
	
</body>
</html>