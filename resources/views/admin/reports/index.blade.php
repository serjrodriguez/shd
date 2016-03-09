@extends('admin.admin_index')

@section('importcss')
    <link rel="stylesheet" href="{{ asset('css/estadisticas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/generador.css') }}">
@endsection

@section('title', 'Reportes')

@section('title2', 'Generador de reportes')

@section('content')
    <div id="opciones_estadisticas">
        <ul>
            <li><a id="btn1" class="btn btn-primary btn-sm">Ver estadisticas de tareas</a></li>
            <li><a id="btn2" class="btn btn-primary btn-sm">Generador de reportes</a></li>
        </ul>
    </div>

    <div class="div-results" id="div-results" style="height: 300px;"></div>

    <div class="div-reports" id="div-reports"></div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#btn1').click(function(){
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.reports.stadistics') }}",
                    success: function(a) {
                        $('#div-reports').empty();
                        $('#div-reports').hide();
                        $('#div-results').html(a);
                        $('#div-results').show();
                    }
                });
            });

            $('#btn2').click(function(){
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.reports.generator') }}",

                    success: function(b){
                        $('#div-results').empty();
                        $('#div-results').hide();
                        $('#div-reports').html(b);
                        $('#div-reports').show();
                    }
                });
            });
        });        
    </script>
@endsection