<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Laracasts\Flash\Flash;
use App\Http\Requests\UsuarioRegistroRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::searchuser($request->name)->orderBy('type', 'DESC')->paginate(5);
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRegistroRequest $request)
    {
        $usuario = new User($request->all());
        $usuario->password = bcrypt($request->password);
        $usuario->save();
        
        //enviamos un mensaje con flash de exito antes de redireccionar.
        Flash::success('El usuario ' . $usuario->name . " ha sido registrado exitosamente.");

        //indicamos a que ruta queremos ser redireccionados despues de guardar al usuario
        return redirect()->route('admin.users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =  User::find($id);
        return view('admin.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->save();

        Flash::warning('El usuario ' .$user->name. ' ha sido actualizado correctamente');  
        return redirect()->route('admin.users.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        Flash::warning("El usuario " . $user->name . " ha sido eliminado satisfactoriamente.");
        return redirect()->route('admin.users.index');
    }

    public function detalles($id)
    {
        $user = User::find($id);
        return view('admin.users.detalles')->with('user', $user);
    }
}
