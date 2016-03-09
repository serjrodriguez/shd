<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<script src="{{ asset('jquery/jquery-2.2.0.js')}}"></script>
	<script src="{{ asset('jquery/jquery-2.2.0.min.js') }}"></script>
	<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('Highcharts-4.2.1/js/highcharts.js') }}"></script>
    <script src="{{ asset('Highcharts-4.2.1/js/exporting.js') }}"></script>
    <script src="{{ asset('Highcharts-4.2.1/theme.js') }}"></script>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}">
	<title>Generador de Reportes</title>
</head>
<body>
	
	@if($request->campos == 'tareas_finalizadas' && $request->periodo == 'dia') 

        <script>
            
                $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Numero de tareas finalizadas por usuario, periodo por dia.'
                    },
                    subtitle: {
                        text: ['Periodo del {{$request->fecha_inicio}} al {{$request->fecha_fin}}']
                    },
                    xAxis: {
                        categories: [
                        @foreach($tareas_fin_empleado as $tarea)
                            @if($tarea->fecha_inicio == null)
                            @else
                                "{{$tarea->fecha_inicio}}",
                            @endif
                        @endforeach
                        ],
                        crosshair: true,
                    },
                    exporting: {
                        buttons:{
                            contextButton:{
                                align:"right",
                                enable: true,
                                height: 20,
                                verticalAlign: "top",
                            },
                        },
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Numero de tareas finalizadas'
                        },
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.25,
                            borderWidth: 0
                        }
                    },
                    series: [
                    @foreach($tareas_fin_empleado as $tarea)
                    {
                        name: '{{$tarea->name}}',
                        data: [
                                
                                {{$tarea->total_tareas_fin}},
                                
                        ]
                    },
                    @endforeach
                    ]
                });
            });

        </script>

       @elseif($request->campos == 'tareas_finalizadas' && $request->periodo == 'mensual')
	
			<script>
            
                $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Numero de tareas finalizadas por usuario, periodo mensual.'
                    },
                    subtitle: {
                        text: ['Periodo del {{$request->fecha_inicio}} al {{$request->fecha_fin}}']
                    },
                    xAxis: {
                        categories: [
                        @foreach($tareas_fin as $tarea)
                            @if($tarea->fecha_inicio == null)
                            @else
                                "{{$tarea->fecha_inicio}}",
                            @endif
                        @endforeach
                        ],
                        crosshair: true,
                    },
                    exporting: {
                        buttons:{
                            contextButton:{
                                align:"right",
                                enable: true,
                                height: 20,
                                verticalAlign: "top",
                            },
                        },
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Numero de tareas finalizadas'
                        },
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.25,
                            borderWidth: 0
                        }
                    },
                    series: [
                    @foreach($tareas_fin as $tarea)
                    {
                        name: '{{$tarea->name}}',
                        data: [
                                
                                {{$tarea->total_tareas_fin}},
                                
                        ]
                    },
                    @endforeach
                    ]
                });
            });

        	</script>

        @elseif($request->campos == 'tareas_pendientes' && $request->periodo == 'dia')

        <script>
            
                $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Numero de tareas pendientes por usuario, periodo por dia.'
                    },
                    subtitle: {
                        text: ['Periodo del {{$request->fecha_inicio}} al {{$request->fecha_fin}}']
                    },
                    xAxis: {
                        categories: [
                        @foreach($tareas as $tarea)
                            @if($tarea->fecha_inicio == null)
                            @else
                                "{{$tarea->fecha_inicio}}",
                            @endif
                        @endforeach
                        ],
                        crosshair: true,
                    },
                    exporting: {
                        buttons:{
                            contextButton:{
                                align:"right",
                                enable: true,
                                height: 20,
                                verticalAlign: "top",
                            },
                        },
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Numero de tareas pendientes'
                        },
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.25,
                            borderWidth: 0
                        }
                    },
                    series: [
                    @foreach($tareas as $tarea)
                    {
                        name: '{{$tarea->name}}',
                        data: [
                                
                                {{$tarea->total_tareas_pen}},
                                
                        ]
                    },
                    @endforeach
                    ]
                });
            });

        </script>

        @elseif($request->campos == 'tareas_finalizadas_pendientes')

        <script>
            
            $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Numero de tareas finalizadas y pendientes de cada usuario.'
                    },
                    subtitle: {
                        text: ['Periodo del {{$request->fecha_inicio}} al {{$request->fecha_fin}}']
                    },
                    xAxis: {
                        categories: [
                        "Pendientes",
                        "Finalizadas",
                        ],
                        crosshair: true,
                    },
                    exporting: {
                        buttons:{
                            contextButton:{
                                align:"right",
                                enable: true,
                                height: 20,
                                verticalAlign: "top",
                            },
                        },
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Numero de tareas.'
                        },
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.25,
                            borderWidth: 0
                        }
                    },
                    series: [
                    {
                        name: "{{ $empleado->name }}",
                        data: [
                        @foreach($tareas_pen_empleado as $tareas_pen)
                        @if($tareas_pen->name == $empleado->name)
                        {{ $tareas_pen->total_tareas_pen}},
                        @endif
                        @endforeach
                        @foreach($tareas_fin_empleado as $tareas_fin)
                        @if($tareas_fin->name == $empleado->name)
                        {{ $tareas_fin->total_tareas_fin }},
                        @endif
                        @endforeach

                        ]
                    },

                    ]
                });
            });

        </script>			


       @endif


	<div class="container" id="container"  style="height: 300px;"></div><br><br>
    <div style="text-align: right; margin-right: 5%;" >
    <a type="button" href="{{ route('members.reports.index')}}" class="btn btn-primary btn-sm">Volver a mis reportes</a>
    </div>

</body>
</html>