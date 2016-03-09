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

        @if($request->campos == 'tareas_pendientes' && $empleado == null && $request->periodo == 'dia')

        <script>
            
                        $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Numero de tareas pendientes por dia'
                    },
                    subtitle: {
                        text: ['Periodo del {{$request->fecha_inicio}} al {{$request->fecha_fin}}']
                    },
                    xAxis: {
                        categories: [
                        @foreach($tareas_pendientes as $tarea)
                            '{{ $tarea->fecha_inicio }}',
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
                    series: [{
                        name: 'Tareas Pendientes',
                        data: [
                                @foreach($tareas_pendientes as $tarea)
                                {{$tarea->numero_tareas}},
                                @endforeach
                        ],

                    }]
                });
            });

        </script>

        @elseif($request->campos == 'tareas_finalizadas' && $empleado == null && $request->periodo == 'dia')

            <script>
            
                        $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Numero de tareas finalizadas por dia'
                    },
                    subtitle: {
                        text: ['Periodo del {{$request->fecha_inicio}} al {{$request->fecha_fin}}']
                    },
                    xAxis: {
                        categories: [
                        @foreach($tareas_finalizadas as $tarea)
                            '{{ $tarea->fecha_inicio }}',
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
                    series: [{
                        name: 'Tareas Finalizadas',
                        data: [
                        @foreach($tareas_finalizadas as $tareas)
                        {{$tareas->numero_tareas}},
                        @endforeach
                        ],
                    }]
                });
            });

        </script>

        @elseif($request->campos == 'tareas_finalizadas_pendientes' && $empleado == null && $request->periodo == 'dia')

        <script>
            
            $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Numero de tareas finalizadas y pendientes por dia'
                    },
                    subtitle: {
                        text: ['Periodo del {{$request->fecha_inicio}} al {{$request->fecha_fin}}']
                    },
                    xAxis: {
                        categories: [
                        @foreach($tareas_fin_pen as $tarea)
                            '{{ $tarea->fecha_inicio }}',
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
                            pointPadding: 0.30,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name: 'Tareas Finalizadas',
                        data: [
                        @foreach($tareas_fin_pen as $tareas)
                            @if($tareas->status_tarea == 'pendiente')
                                0,
                            @elseif($tareas->status_tarea == 'finalizada')
                                {{$tareas->num_tareas}},
                            @endif
                        @endforeach
                        ]},{
                        name: 'Tareas Pendientes',
                        data: [
                        @foreach($tareas_fin_pen as $tareas)
                            @if($tareas->status_tarea == 'finalizada')
                                0,
                            @elseif($tareas->status_tarea == 'pendiente')
                                {{$tareas->num_tareas}},
                            @endif
                        @endforeach
                        ]
                    }]
                });
            });

        </script>

        @elseif($request->campos == 'tareas_finalizadas' && $empleado == null && $request->periodo == 'mensual')

        <script>
            
            $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Numero de tareas finalizadas por mes'
                    },
                    subtitle: {
                        text: ['Periodo del {{$request->fecha_inicio}} al {{$request->fecha_fin}}']
                    },
                    xAxis: {
                        categories: [
                        'Enero',
                        'Feb',
                        'Mar',
                        'Abr',
                        'May',
                        'Jun',
                        'Jul',
                        'Ago',
                        'Sep',
                        'Oct',
                        'Nov',
                        'Dec',
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
                            text: 'Numero de tareas finalizadas por mes'
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
                            pointPadding: 0.30,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name: 'Tareas Finalizadas Por Mes',
                        data: [
                                @foreach($tareas_fin_mensual as $tareas)
                                    @if($tareas->mes == 1)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 2)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 3)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 4)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 5)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 6)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 7)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 8)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 9)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 10)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 11)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 12)
                                    {{ $tareas->tareas_mes }},
                                    @endif
                                @endforeach 
                        ]
                    }]
                });
            });

        </script>

        @elseif($request->campos == 'tareas_pendientes' && $empleado == null && $request->periodo == 'mensual')

        <script>
            
            $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Numero de tareas pendientes por mes.'
                    },
                    subtitle: {
                        text: ['Periodo del {{$request->fecha_inicio}} al {{$request->fecha_fin}}']
                    },
                    xAxis: {
                        categories: [
                        'Enero',
                        'Feb',
                        'Mar',
                        'Abr',
                        'May',
                        'Jun',
                        'Jul',
                        'Ago',
                        'Sep',
                        'Oct',
                        'Nov',
                        'Dec',
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
                            text: 'Numero de tareas pendientes por mes.'
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
                            pointPadding: 0.30,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name: 'Tareas Pendientes.',
                        data: [
                                @foreach($tareas_pen_mensual as $tareas)
                                    @if($tareas->mes == 1)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 2)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 3)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 4)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 5)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 6)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 7)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 8)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 9)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 10)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 11)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 12)
                                    {{ $tareas->tareas_mes }},
                                    @endif
                                @endforeach 
                        ]
                    }]
                });
            });

        </script>

        @elseif($request->campos == 'tareas_finalizadas_pendientes' && $empleado == null && $request->periodo == 'mensual')

        <script>
            
            $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Numero de tareas finalizadas y pendientes por mes.'
                    },
                    subtitle: {
                        text: ['Periodo del {{$request->fecha_inicio}} al {{$request->fecha_fin}}']
                    },
                    xAxis: {
                        categories: [
                        'Enero',
                        'Feb',
                        'Mar',
                        'Abr',
                        'May',
                        'Jun',
                        'Jul',
                        'Ago',
                        'Sep',
                        'Oct',
                        'Nov',
                        'Dec',
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
                            text: 'Tareas finalizadas y pendientes por mes.'
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
                            pointPadding: 0.30,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name: 'Tareas Pendientes.',
                        data: [
                                @foreach($tareas_pen_mensual as $tareas)
                                    @if($tareas->mes == 1)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 2)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 3)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 4)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 5)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 6)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 7)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 8)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 9)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 10)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 11)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 12)
                                    {{ $tareas->tareas_mes }},
                                    @endif
                                @endforeach 
                        ]
                    },
                    {

                        name: 'Tareas Finalizadas.',
                        data: [
                                @foreach($tareas_fin_mensual as $tareas)
                                    @if($tareas->mes == 1)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 2)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 3)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 4)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 5)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 6)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 7)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 8)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 9)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 10)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 11)
                                    {{ $tareas->tareas_mes }},
                                    @elseif($tareas->mes == 12)
                                    {{ $tareas->tareas_mes }},
                                    @endif
                                @endforeach 
                            ]

                    }]
                });
            });

        </script>

        @elseif($request->campos == 'tareas_finalizadas' && $empleado == null && $request->periodo == 'semanal')

        <script>
            
            $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Numero de tareas finalizadas por semana'
                    },
                    subtitle: {
                        text: ['Periodo del {{$request->fecha_inicio}} al {{$request->fecha_fin}}']
                    },
                    xAxis: {
                        categories: [
                        @foreach($tareas_finalizadas_semanal as $tarea)
                            "del {{ $tarea->PrimerDiaSemana }} al {{$tarea->UltimoDiaSemana}}",
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
                    series: [{
                        name: 'Tareas Finalizadas',
                        data: [
                        @foreach($tareas_finalizadas_semanal as $tareas)
                        {{$tareas->num_tareas_sem /2}},
                        @endforeach
                        ],
                    }]
                });
            });

        </script>

        @elseif($request->campos == 'tareas_pendientes' && $empleado == null && $request->periodo == 'semanal')

        <script>
            
            $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Numero de tareas pendientes por semana'
                    },
                    subtitle: {
                        text: ['Periodo del {{$request->fecha_inicio}} al {{$request->fecha_fin}}']
                    },
                    xAxis: {
                        categories: [
                        @foreach($tareas_pendientes_semanal as $tarea)
                            "del {{ $tarea->PrimerDiaSemana }} al {{$tarea->UltimoDiaSemana}}",
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
                    series: [{
                        name: 'Tareas Pendientes',
                        data: [
                        @foreach($tareas_pendientes_semanal as $tareas)
                        {{$tareas->num_tareas_sem }},
                        @endforeach
                        ],
                    }]
                });
            });

        </script>

        @elseif($request->campos == 'tareas_finalizadas_pendientes' && $empleado == null && $request->periodo == 'semanal')

        <script>
            
            $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Numero de tareas pendientes por semana'
                    },
                    subtitle: {
                        text: ['Periodo del {{$request->fecha_inicio}} al {{$request->fecha_fin}}']
                    },
                    xAxis: {
                        categories: [
                        @foreach($tareas_pendientes_semanal as $tarea)
                            "del {{ $tarea->PrimerDiaSemana }} al {{$tarea->UltimoDiaSemana}}",
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
                    series: [{
                        name: 'Tareas Pendientes',
                        data: [
                        @foreach($tareas_pendientes_semanal as $tareas)
                        {{$tareas->num_tareas_sem }},
                        @endforeach
                        ],
                    }]
                });
            });

        </script>

        @elseif($request->campos == 'tareas_finalizadas' && $empleado != null && $request->periodo == 'dia') 
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
                    @foreach($tareas as $tarea)
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

        @elseif($request->campos == 'tareas_pendientes' && $empleado != null && $request->periodo == 'dia')

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

        @elseif($request->campos == 'tareas_finalizadas_pendientes' && $empleado != null)

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
                    @foreach($empleado as $empleado)
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
                    @endforeach

                    ]
                });
            });

        </script>

        @endif

        

	<div class="container" id="container"  style="height: 300px;"></div><br><br>
    
    <div style="text-align: right; margin-right: 5%;" >
    <a type="button" href="{{ route('admin.reportes.index')}}" class="btn btn-primary btn-sm">Volver a mis reportes</a>
    </div>

</body>
</html>