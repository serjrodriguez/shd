<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarea;
use App\Empleado_tarea;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
        SELECT * FROM empleado_tarea 
        INNER JOIN tarea ON tarea.id = empleado_tarea.id
        iNNER JOIN users ON users.id = empleado_tarea.id WHERE empleado_tarea.id = 1;
    */

    public function index()
    {
        $tareas = \DB::table('empleado_tarea')  ->select('empleado_tarea.*',

                                                        'empleado_tarea.id as id_empleado',
                                                        'tarea.id as id_tarea',
                                                        'tarea.nombre_tarea',
                                                        'tarea.prioridad_tarea',
                                                        'tarea.status_tarea'

                                                        )
                                                ->join('tarea', 'tarea.id', '=', 'empleado_tarea.id')
                                                ->join('users', 'users.id', '=', 'empleado_tarea.id')
                                                ->get();

        return view('empleado.tareas.index')->with('tareas', $tareas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
