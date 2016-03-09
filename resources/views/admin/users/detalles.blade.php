@extends('admin.admin_index')

@section('title', 'Detalle de usuario')

@section('title2', 'Usuario '. $user->name)

@section('content')

	<div class="panel panel-default">
  		<div class="panel-heading">Detalles del usuario</div>
  			<div class="panel-body">
    			ID del usuario: {{$user->id}} <br><br>
    			Nombre completo: {{$user->name}} <br><br>
    			Correo electronico: {{ $user->email }} <br><br>
    			Tipo de usuario: {{ $user->type }} <br><br>
    			Numero de nomina: {{ $user->numero_nomina }} <br><br>
    			Telefono: {{ $user->telefono }} <br><br>
    			Direccion: {{$user->direccion}} <br><br>

			<div style="text-align: right;">
      <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-chevron-left"></span>Volver al listado de usuarios</a>
			<a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info btn-sm">Editar Usuario&nbsp;<span class="glyphicon glyphicon-pencil"></span></a>
			<a href="{{ route('admin.users.destroy', $user->id) }}" onclick=" return confirm('¿Seguro que desea eliminar el usuario seleccionado?')" class="btn btn-danger btn-sm">Eliminar Usuario&nbsp;<span class="glyphicon glyphicon-remove"></span></a>
			</div>

  			</div>
	</div>

@endsection