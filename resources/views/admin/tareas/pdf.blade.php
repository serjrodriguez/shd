<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PDF</title>
	<link rel="stylesheet" type="text/css" href="../public/css/pdf.css">
  <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.css">
	<img  class="logoshd" src="../public/img/nav_logo.png"/>
	<img  class="logodl" src="../public/img/logodl.png"/> 
  <div id="container">
    <span class="leg_corp">Corporativo DL</span>
  </div>

</head>
<body>
  <br><br>
	<div class="panel panel-default">
  	     <span class="glyphicon glyphicon-euro"></span><div class="panel-heading"><h3>Detalles de la tarea</h3></div>
  			<div class="panel-body">
    			<h4 class="detalles_tarea">Id de la tarea: {{ $tarea->id }} </h4>
    			<h4 class="detalles_tarea">Nombre de la tarea: {{$tarea->nombre_tarea}} </h4>
    			<h4 class="detalles_tarea">Descripcion: {{ $tarea->descripcion_tarea }} </h4>
          <h4 class="detalles_tarea">Prioridad de la tarea: {{ $tarea->prioridad_tarea }}</h4>
          <h4 class="detalles_tarea">Status de la tarea: {{ $tarea->status_tarea }}</h4>
          <h4 class="detalles_tarea">Fecha de inicio: {{ $tarea->fecha_inicio }}</h4>
    		  <h4 class="detalles_tarea">Fecha limite: {{ $tarea->fecha_limite }}</h4>
          <h4 class="detalles_tarea">Fecha finalizacion: {{ $tarea->fecha_fin }} </h4>
        </div>
    </div>

</body>
</html>