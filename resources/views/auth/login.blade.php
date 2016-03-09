@if(Auth::guest())
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bienvenido | Login de usuarios </title>
  <script src="{{asset('jquery/jquery-2.2.0.js')}}"></script>
	<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('css/login.css')}}">
  <link rel="shortcut icon" href="{{ asset('favicon_128x128.ico') }}" type="image/x-icon">
	<script src="{{asset('bootstrap/js/bootstrap.js')}}"></script>
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
                        {!! Form::open(['route' => 'auth.login', 'method' => 'POST']) !!}
                            	
                              <div class="form-group">
                                    {!! Form::label('email', 'Email') !!}
                                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'example@email.com'])!!}
                                  <span class="help-block"></span>
                              </div>

                              <div class="form-group">
                                    {!! Form::label('password', 'Contraseña') !!}
                                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '**********'])!!}
                                  <span class="help-block"></span>
                              </div>
                              {!! Form::submit('Iniciar Sesion', ['class' => 'btn btn-primary']) !!}
                              
                        {!! Form::close() !!}
                        @else

                        <script>window.location.href="{{ route('admin.users.index') }}";</script>

                      @endif
                      </div>
                  </div>
                    <div class="col-xs-6">
                        <p class="lead"> * Introduce tu email y contraseña<span class="text-success"></span></p>
                        <ul class="list-unstyled" style="line-height: 2">
                        </ul>
                    </div>
              </div>
          </div>
      </div>
  </div>
</body>
</html>