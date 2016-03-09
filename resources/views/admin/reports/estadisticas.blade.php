<div id="calcula_porcentaje">
<script src="{{ asset('Highcharts-4.2.1/js/exporting.js') }}"></script>
{!! $contador_pendientes = 0 !!}
{!! $contador_finalizadas = 0 !!}
@foreach($tarea as $tarea)
	@if($tarea->status_tarea == "pendiente")
	{!! $contador_pendientes++ !!}
	@elseif($tarea->status_tarea == "finalizada")
	{!! $contador_finalizadas++ !!}
	@endif
@endforeach

{{ $total = $contador_pendientes + $contador_finalizadas }}
{{ $porc_pend = $contador_pendientes * $total / 100 }}
{{ $porc_final = $contador_finalizadas * $total / 100 }}
</div>


<script type="text/javascript">
    $(function () {
    $('#div-results').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
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
        title: {
            text: 'Porcentaje de todas las tareas finalizadas y pendientes.'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Porcentaje:',
            data: [
                ['Pendientes',   {{$porc_pend}}],
                ['Finalizadas',  {{$porc_final}}],
            ]
        }]
    });
});
</script>