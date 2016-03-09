<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tarea;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use App\Http\Controllers\Controller;
use App\Http\Requests\TareaRegistroRequest;
use App\User;
use App\Empleado_tarea;
use Carbon\Carbon;

class TareasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tareas = Tarea::searchtarea($request->name)->orderBy('prioridad_tarea', 'ASC')->paginate(7);
        return view('admin.tareas.index')->with('tareas', $tareas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tareas.create_tarea');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TareaRegistroRequest $request)
    {
        $tarea = new Tarea($request->all());
        $tarea->save();
        
        //enviamos un mensaje con flash de exito antes de redireccionar.
        Flash::success('La tarea ' . $tarea->nombre_tarea . " ha sido creada exitosamente.");

        //indicamos a que ruta queremos ser redireccionados despues de guardar al usuario
        return redirect()->route('admin.tareas.index');
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
        $tarea = Tarea::find($id);

        $fecha_i = date_create($tarea->fecha_inicio);
        $tarea->fecha_inicio = date_format($fecha_i, 'd-m-Y');
        $fecha_l = date_create($tarea->fecha_limite);
        $tarea->fecha_limite = date_format($fecha_l, 'd-m-Y');
        return view('admin.tareas.edit')->with('tarea', $tarea);
    }

    public function generaPDF($id)
    {
        $tarea = Tarea::find($id);

        $fecha_i = date_create($tarea->fecha_inicio);
        $tarea->fecha_inicio = date_format($fecha_i, 'd-m-Y');
        $fecha_l = date_create($tarea->fecha_limite);
        $tarea->fecha_limite = date_format($fecha_l, 'd-m-Y');
        $fecha_f = date_create($tarea->fecha_fin);
        $tarea->fecha_fin = date_format($fecha_f, 'd-m-Y');
        
        $view =  \View::make('admin.tareas.pdf', compact('tarea'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream();
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
        $tarea = Tarea::find($id);
        // $tarea->nombre_tarea = $request->nombre_tarea;
        // $tarea->prioridad_tarea = $request->prioridad_tarea;
        // $tarea->status_tarea = $request->status_tarea;
        // $tarea->descripcion_tarea = $request->descripcion_tarea;
        // $tarea->fecha_inicio = $request->fecha_inicio;
        // $tarea->fecha_fin = $request->fecha_fin;
        $tarea->fill($request->all());
        $tarea->save();

        Flash::warning("La tarea " .$tarea->nombre_tarea. " ha sido actualizada correctamente.");
        return redirect()->route('admin.tareas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarea = Tarea::find($id);
        $tarea->delete();

        Flash::warning("La tarea " .$tarea->nombre_tarea. " ha sido eliminada correctamente.");
        return redirect()->route('admin.tareas.index');
    }

    public function detalles($id)
    {
        $tarea = Tarea::find($id);
        $fecha_i = date_create($tarea->fecha_inicio);
        $tarea->fecha_inicio = date_format($fecha_i, 'd-m-Y');
        $fecha_l = date_create($tarea->fecha_limite);
        $tarea->fecha_limite = date_format($fecha_l, 'd-m-Y');
        $fecha_f = date_create($tarea->fecha_fin);
        $tarea->fecha_fin = date_format($fecha_f, 'd-m-Y');
        return view('admin.tareas.detalles')->with('tarea', $tarea);
    }

    public function asignar($id)
    {
        $tarea = Tarea::find($id);
        $usuarios = User::orderBy('type', 'DESC')->paginate();
        return view('admin.tareas.asignar')->with('tarea', $tarea)->with('usuarios', $usuarios);
    }

    public function saveasign(Request $request, $id) 
    {
        
        foreach ($request->id_usuario as $id_usuario) {
            $relacion = new Empleado_tarea();
            $relacion->id = $id_usuario;
            $relacion->id_tarea = $id;
            $relacion->save();
        }
        

        Flash::warning('La tarea ha sido asignada correctamente.');
        return redirect()->route('admin.tareas.index');

    }

    public function asignacionesAdmin()
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

        return view('admin.tareas.misasignaciones')->with('tareas', $tareas);
    }

    public function detallesMembers($id)
    {

        $tarea = Tarea::find($id);
        $fecha_i = date_create($tarea->fecha_inicio);
        $tarea->fecha_inicio = date_format($fecha_i, 'd-m-Y');
        $fecha_l = date_create($tarea->fecha_limite);
        $tarea->fecha_limite = date_format($fecha_l, 'd-m-Y');
        $fecha_f = date_create($tarea->fecha_fin);
        $tarea->fecha_fin = date_format($fecha_f, 'd-m-Y');
        return view('empleado.tareas.detalles')->with('tarea', $tarea);

    }

    public function editmembers($id)
    {
        $tarea = Tarea::find($id);
        $fecha_i = date_create($tarea->fecha_inicio);
        $tarea->fecha_inicio = date_format($fecha_i, 'd-m-Y');
        $fecha_l = date_create($tarea->fecha_limite);
        $tarea->fecha_limite = date_format($fecha_l, 'd-m-Y');
        return view('empleado.tareas.edit')->with('tarea', $tarea);
    }

    public function updatemembers(Request $request, $id)
    {
        $tarea = Tarea::find($id);
        // $tarea->nombre_tarea = $request->nombre_tarea;
        // $tarea->prioridad_tarea = $request->prioridad_tarea;
        // $tarea->status_tarea = $request->status_tarea;
        // $tarea->descripcion_tarea = $request->descripcion_tarea;
        // $tarea->fecha_inicio = $request->fecha_inicio;
        // $tarea->fecha_fin = $request->fecha_fin;
        $tarea->fill($request->all());
        $tarea->save();

        Flash::warning("La tarea " .$tarea->nombre_tarea. " ha sido actualizada correctamente.");
        return redirect()->route('admin.tareas.index');
    }

}
