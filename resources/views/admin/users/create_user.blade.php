@extends('admin.admin_index')

@section('title', 'Registro de usuarios')

@section('title2', 'Registro de usuarios')

@section('content')

		@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					@foreach($errors->all() as $error)
						<li> {{ $error }} </li>
					@endforeach
				</ul>
			</div>
		@endif

		
		{!! Form::open(['route'=>'admin.users.store', 'method' => 'POST']) !!}
		
		<div class="form-group">
		{!! Form::label('name', 'Nombre')!!}
		{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre Completo' ,'required']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('email', 'Email')!!}
		{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'example@gmail.com' ,'required']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('password', 'Contraseña')!!}
		{!! Form::password('password',['class' => 'form-control', 'placeholder' => '***********' ,'required']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('type', 'Tipo de usuario')!!}
		{!! Form::select('type', ['empleado' => 'Empleado', 'administrador' => 'Administrador'], 'empleado', ['class' => 'form-control', 'required']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('numero_nomina', 'Numero de nomina')!!}
		{!! Form::text('numero_nomina', null, ['class' => 'form-control', 'placeholder' => '00000', 'maxlength' => "7" ,'required']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('telefono', 'Telefono')!!}
		{!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'ex. 5547835471', 'maxlength' => "10" ,'required']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('direccion', 'Direccion')!!}
		{!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'Av. Plaza Mayor #13','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Registrar Usuario', ['class' => 'btn btn-primary btn-sm']) !!}
			<a href="{{ route('admin.users.index') }}" class="btn btn-info btn-sm">Volver al listado de usuarios</a>
		</div>

		{!! Form::close() !!}


@endsection