@extends('admin.admin_index')

@section('title', 'Editar Usuarios')

@section('title2', 'Editar usuarios')

@section('content')
		
		{!! Form::open(['route'=>['admin.users.update', $user], 'method' => 'PUT']) !!}
		
		<div class="form-group">
		{!! Form::label('name', 'Nombre')!!}
		{!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Nombre Completo' ,'required']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('email', 'Email')!!}
		{!! Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'example@gmail.com' ,'required']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('password', 'Contraseña')!!}
		{!! Form::password('password', ['class' => 'form-control', 'placeholder' => '***********' ,'required']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('type', 'Tipo de usuario')!!}
		{!! Form::select('type', ['empleado' => 'Empleado', 'administrador' => 'Administrador'], $user->type, ['class' => 'form-control', 'required']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('numero_nomina', 'Numero de nomina')!!}
		{!! Form::text('numero_nomina', $user->numero_nomina, ['class' => 'form-control', 'placeholder' => '00000', 'maxlength' => "7" ,'required']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('telefono', 'Telefono')!!}
		{!! Form::text('telefono', $user->telefono, ['class' => 'form-control', 'placeholder' => 'ex. 5547835471', 'maxlength' => "10" ,'required']) !!}
		</div>

		<div class="form-group">
		{!! Form::label('direccion', 'Direccion')!!}
		{!! Form::textarea('direccion', $user->direccion, ['class' => 'form-control', 'placeholder' => 'Av. Plaza Mayor #13','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Actualizar', ['class' => 'btn btn-primary btn-sm']) !!} 

		{!! Form::close() !!}
		<a href="{{ route('admin.users.index') }}" class="btn btn-info btn-sm">Volver al listado de usuarios</a><br><br>
		</div>

@endsection