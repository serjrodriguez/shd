<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bienvenido | Login de usuarios </title>
	<script src="{{asset('bootstrap/js/bootstrap.js')}}"></script>
	<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('css/login.css')}}">
  <link rel="shortcut icon" href="{{ asset('favicon_128x128.ico') }}" type="image/x-icon">
</head>
<body>
		
		<div id="login-overlay" class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Bienvenido a Service Help Desk</h4>
            </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-6">
                      <div class="well">
						{!! Form::open() !!}
							
							<div class="form-group">
								{!! Form::label('type', 'Tipo de usuario')!!}
								{!! Form::select('type', ['empleado' => 'Empleado', 'administrador' => 'Administrador'], 'empleado', ['class' => 'form-control', 'required']) !!}
							</div>

							<div class="form-group">
								
								{!! Form::submit('Siguiente', ['class' => 'btn btn-primary']) !!}

							</div>

						{!! Form::close() !!}

                      </div>
                  </div>
                    <div class="col-xs-6">
                        <p class="lead"> Para comenzar selecciona tu nivel de usuario<span class="text-success"></span></p>
                        <ul class="list-unstyled" style="line-height: 2">
                        </ul>
                    </div>
              </div>
          </div>
      </div>
  </div>
</body>
</html>