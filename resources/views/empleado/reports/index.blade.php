@extends('empleado.index')

@section('importcss')
    <link rel="stylesheet" href="{{ asset('css/estadisticas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/generador.css') }}">
@endsection

@section('title', 'Reportes')

@section('title2', 'Generador de reportes')

@section('content')

    <a id="btn2" class="btn btn-primary btn-sm">Generador de reportes</a> <br><br>


    <div class="div-results" id="div-results" style="height: 300px;"></div>

    <div class="div-reports" id="div-reports"></div>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#btn2').click(function(){
                $.ajax({
                    type: "GET",
                    url: "{{ route('members.reports.membersgenerator') }}",

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