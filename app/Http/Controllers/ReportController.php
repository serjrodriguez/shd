<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Khill\Lavacharts\Laravel;
use App\Tarea;
use App\User;
use Laracasts\Flash\Flash;
use Illuminate\Support\Collection as Collection;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reports.index');
    }

    public function reportsIndexMembers()
    {
        return view('empleado.reports.index');
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

    public function muestaEstadistica()
    {

        $tarea = Tarea::all();
        return view('admin.reports.estadisticas')->with('tarea', $tarea);

    }

    public function generator()
    {
        $users = User::all();
        return view('admin.reports.generator')->with('users', $users);
    }

    public function membersgenerator()
    {
        return view('empleado.reports.generator');
    }

    public function generaReport(Request $request){
    /*
    /   Aqui inicia el codigo que trae todas las tareas que contienen alguna fecha dentro del periodo enviado por el usuario
    /   ya sea en el campo fecha_limite, fecha_inicio o fecha_fin de la tarea
    */

        //obtiene todas las fechas que se encuentren dentro del periodo de tiempo dado
        // $arrayFechas=array();
        // $fechaMostrar = $request->fecha_inicio;

        // while(strtotime($fechaMostrar) <= strtotime($request->fecha_fin)) {
        // $arrayFechas[]=$fechaMostrar;
        // $fechaMostrar = date("Y-m-d", strtotime($fechaMostrar . " + 1 day"));
        // }

        //Selecciona todas las tareas que contengan alguna fecha dentro del periodo seleccionado en el campo fecha_inicio
        // foreach ($arrayFechas as $fecha => $value) 
        // {

            /*
            /   Este codigo es para traer las tareas cuando no esta marcado el checkbox de empleados
            */

            $empleado = User::find($request->empleados);

            if($request->campos == 'tareas_finalizadas' && $empleado == null && $request->periodo == 'dia') 
            {
                $tareas_finalizadas = \DB::select('CALL tareas_finalizadas_sp("'.$request->fecha_inicio.'", "'.$request->fecha_fin.'")');
                return view('admin.reports.generaReport')->with('request', $request)->with('empleado', $empleado)->with('tareas_finalizadas', $tareas_finalizadas);

            }
            elseif($request->campos == 'tareas_pendientes' && $empleado == null && $request->periodo == 'dia') 
            {
                $tareas_pendientes = \DB::select('CALL tareas_pendientes_sp("'.$request->fecha_inicio.'", "'.$request->fecha_fin.'")');
                return view('admin.reports.generaReport')->with('request', $request)->with('empleado', $empleado)->with('tareas_pendientes', $tareas_pendientes);

            }
            elseif($request->campos == 'tareas_finalizadas_pendientes' && $empleado == null && $request->periodo == 'dia') 
            {
                $tareas_fin_pen = \DB::select('CALL tareas_fin_pen_sp("'.$request->fecha_inicio.'", "'.$request->fecha_fin.'")');
                return view('admin.reports.generaReport')->with('request', $request)->with('empleado', $empleado)->with('tareas_fin_pen', $tareas_fin_pen);  
            }
            elseif($request->campos == 'tareas_finalizadas' && $empleado == null && $request->periodo == 'mensual') 
            {
                $tareas_fin_mensual = \DB::select('CALL tareas_finalizadas_mensual_sp');
                return view('admin.reports.generaReport')->with('request', $request)->with('empleado', $empleado)->with('tareas_fin_mensual', $tareas_fin_mensual);
            }
            elseif($request->campos == 'tareas_pendientes' && $empleado == null && $request->periodo == 'mensual') 
            {
                $tareas_pen_mensual = \DB::select('CALL tareas_pendientes_mensual_sp');
                return view('admin.reports.generaReport')->with('request', $request)->with('empleado', $empleado)->with('tareas_pen_mensual', $tareas_pen_mensual);
            }
            elseif($request->campos == 'tareas_finalizadas_pendientes' && $empleado == null && $request->periodo =='mensual') 
            {
                $tareas_pen_mensual = \DB::select('CALL tareas_pendientes_mensual_sp');
                $tareas_fin_mensual = \DB::select('CALL tareas_finalizadas_mensual_sp');
                return view('admin.reports.generaReport')->with('request', $request)->with('empleado', $empleado)->with('tareas_pen_mensual', $tareas_pen_mensual)->with('tareas_fin_mensual', $tareas_fin_mensual);
            }
            elseif($request->campos == 'tareas_finalizadas' && $empleado == null && $request->periodo =='semanal')
            {
                $tareas_finalizadas = \DB::select('CALL tareas_finalizadas_sp("'.$request->fecha_inicio.'", "'.$request->fecha_fin.'")');

                foreach ($tareas_finalizadas as $tareas) {
                    $tareas_finalizadas_semanal = \DB::select('CALL num_tareas_fin_semana_sp("'.$tareas->fecha_inicio.'")');
                }

                //dd($tareas_finalizadas_semanal);
                return view('admin.reports.generaReport')   ->with('request', $request)->with('empleado', $empleado)
                                                            ->with('tareas_finalizadas_semanal', $tareas_finalizadas_semanal);
            }
            elseif($request->campos == 'tareas_pendientes' && $empleado == null && $request->periodo =='semanal') 
            {
                $tareas_pendientes = \DB::select('CALL tareas_pendientes_sp("'.$request->fecha_inicio.'", "'.$request->fecha_fin.'")');

                foreach ($tareas_pendientes as $tareas) {
                    $tareas_pendientes_semanal = \DB::select('CALL num_tareas_pen_sem_sp("'.$tareas->fecha_inicio.'")');
                }

                //dd($tareas_pendientes_semanal);
                return view('admin.reports.generaReport')   ->with('request', $request)->with('empleado', $empleado)
                                                            ->with('tareas_pendientes_semanal', $tareas_pendientes_semanal);
            }
            elseif($request->campos == 'tareas_finalizadas_pendientes' && $empleado == null && $request->periodo =='semanal') 
            {

                $tareas_pendientes = \DB::select('CALL tareas_pendientes_sp("'.$request->fecha_inicio.'", "'.$request->fecha_fin.'")');

                foreach ($tareas_pendientes as $tareas) {
                    $tareas_pendientes_semanal = \DB::select('CALL num_tareas_pen_sem_sp("'.$tareas->fecha_inicio.'")');
                }

                $tareas_finalizadas = \DB::select('CALL tareas_finalizadas_sp("'.$request->fecha_inicio.'", "'.$request->fecha_fin.'")');

                foreach ($tareas_finalizadas as $tareas) {
                    $tareas_finalizadas_semanal = \DB::select('CALL num_tareas_fin_semana_sp("'.$tareas->fecha_inicio.'")');
                }

                return view('admin.reports.generaReport')   ->with('request', $request)->with('empleado', $empleado)
                                                            ->with('tareas_pendientes_semanal', $tareas_pendientes_semanal)
                                                            ->with('tareas_finalizadas_semanal', $tareas_finalizadas_semanal);
                
            }
            elseif($request->campos == 'tareas_finalizadas' && $empleado != null && $request->periodo =='dia') 
            {
                foreach ($request->empleados as $valor) {
                    $tareas_fin_empleado[] = \DB::select('CALL tareas_fin_usuario_sp('.$valor.', "'.$request->fecha_inicio.'", "'.$request->fecha_fin.'")');
                }
                $tareas = array_flatten($tareas_fin_empleado);
                return view('admin.reports.generaReport')   ->with('request', $request)
                                                            ->with('tareas', $tareas)
                                                            ->with('empleado', $empleado);
            }
            elseif($request->campos == 'tareas_pendientes' && $empleado != null && $request->periodo =='dia') 
            {
                foreach ($request->empleados as $valor) {
                    $tareas_pen_empleado[] = \DB::select('CALL tareas_pen_usuario_sp('.$valor.', "'.$request->fecha_inicio.'", "'.$request->fecha_fin.'")');
                }
                $tareas = array_flatten($tareas_pen_empleado);
                return view('admin.reports.generaReport')   ->with('request', $request)
                                                            ->with('tareas', $tareas)
                                                            ->with('empleado', $empleado);
            }
            elseif($request->campos == 'tareas_finalizadas_pendientes' && $empleado != null && $request->periodo =='dia' || $request->periodo =='mensual' || $request->periodo =='semanal') 
            {
                foreach ($request->empleados as $valor) {
                    $tareas_pen_empleado[] = \DB::select('CALL tareas_pen_usuario_sp('.$valor.', "'.$request->fecha_inicio.'", "'.$request->fecha_fin.'")');
                }
                $tareas_pen = array_flatten($tareas_pen_empleado);


                foreach ($request->empleados as $valor) {
                    $tareas_fin_empleado[] = \DB::select('CALL tareas_fin_usuario_sp('.$valor.', "'.$request->fecha_inicio.'", "'.$request->fecha_fin.'")');
                }

                $tareas_pen = array_flatten($tareas_pen_empleado);

                $tareas_fin = array_flatten($tareas_fin_empleado);

                array_flatten($tareas_fin_empleado);

                $tareas_fin = array_flatten($tareas_fin_empleado);

                $tareas_total = array_merge($tareas_pen, $tareas_fin);

                return view('admin.reports.generaReport')   ->with('request', $request)
                                                            ->with('tareas_total', $tareas_total)
                                                            ->with('tareas_pen_empleado', $tareas_pen)
                                                            ->with('tareas_fin_empleado', $tareas_fin)
                                                            ->with('empleado', $empleado);
            }

            /*
            /   Aqui termina el codigo para cuando no esta marcado el checkbox y comienza cuando si lo esta
            */

            // if ($request->checkbox == 'on' && $request->campos == 'tareas_finalizadas') 
            // {

            //     foreach ($request->empleados as $empleados => $valor) 
            //     {    
            //         if ($request->campos == 'tareas_finalizadas') 
            //         {
                
            //             $tareas_fecha_inicio[] = \DB::table('tarea')    ->join('empleado_tarea', 'empleado_tarea.id_tarea', '                                                   =', 'tarea.id')
            //                                                             ->where('fecha_inicio', '=', $value)
            //                                                             ->where('status_tarea', '=' , 'finalizada')
            //                                                             ->where('empleado_tarea.id', '=', $empleados)
            //                                                             ->get();
            //             $tareas_fecha_fin[] = \DB::table('tarea')       ->join('empleado_tarea', 'empleado_tarea.id_tarea', '                                                   =', 'tarea.id')
            //                                                             ->where('fecha_fin', '=', $value)
            //                                                             ->where('status_tarea', '=' , 'finalizada')
            //                                                             ->where('empleado_tarea.id', '=', $empleados)
            //                                                             ->get();
            //             $tareas_fecha_limite[] = \DB::table('tarea')    ->join('empleado_tarea', 'empleado_tarea.id_tarea', '                                                   =', 'tarea.id')
            //                                                             ->where('fecha_limite', '=', $value)
            //                                                             ->where('status_tarea', '=' , 'finalizada')
            //                                                             ->where('empleado_tarea.id', '=', $empleados)
            //                                                             ->get();

            //             $empleado = User::find($request->empleados);

            //             //Reinicia los indices del array y acomoda los elementos para que inicien de nuevo en 0 y los junta en un solo array
            //             $resultados = array_merge($tareas_fecha_inicio, $tareas_fecha_fin, $tareas_fecha_limite);

            //             return view('admin.reports.generaReport')->with('empleado', $empleado)->with('resultados', $resultados);
            //         }
            //         elseif ($request->campos == 'tareas_pendientes') 
            //         {
            //             $tareas_fecha_inicio[] = \DB::table('tarea')    ->join('empleado_tarea', 'empleado_tarea.id_tarea', '                                                   =', 'tarea.id')
            //                                                             ->where('fecha_inicio', '=', $value)
            //                                                             ->where('status_tarea', '=' , 'pendiente')
            //                                                             ->where('empleado_tarea.id', '=', $valor)
            //                                                             ->get();
            //             $tareas_fecha_fin[] = \DB::table('tarea')       ->join('empleado_tarea', 'empleado_tarea.id_tarea', '                                                   =', 'tarea.id')
            //                                                             ->where('fecha_fin', '=', $value)
            //                                                             ->where('status_tarea', '=' , 'pendiente')
            //                                                             ->where('empleado_tarea.id', '=', $valor)
            //                                                             ->get();
            //             $tareas_fecha_limite[] = \DB::table('tarea')    ->join('empleado_tarea', 'empleado_tarea.id_tarea', '                                                   =', 'tarea.id')
            //                                                             ->where('fecha_limite', '=', $value)
            //                                                             ->where('status_tarea', '=' , 'pendiente')
            //                                                             ->where('empleado_tarea.id', '=', $valor)
            //                                                             ->get();

            //             $empleado = User::find($request->empleados);
            //             //Reinicia los indices del array y acomoda los elementos para que inicien de nuevo en 0 y los junta en un solo array
            //             $resultados = array_merge($tareas_fecha_inicio, $tareas_fecha_fin, $tareas_fecha_limite);

            //             return view('admin.reports.generaReport')->with('empleado', $empleado)->with('resultados', $resultados);
            //         }
            //         else
            //         {
            //             $tareas_fecha_inicio[] = \DB::table('tarea')    ->join('empleado_tarea', 'empleado_tarea.id_tarea', '                                                   =', 'tarea.id')
            //                                                             ->join('users', 'users.id', '=', 'empleado_tarea.id')
            //                                                             ->where('fecha_inicio', '=', $value)
            //                                                             ->where('users.id', '=', $empleados->valor)
            //                                                             ->get();
            //             $tareas_fecha_fin[] = \DB::table('tarea')       ->join('empleado_tarea', 'empleado_tarea.id_tarea', '                                                   =', 'tarea.id')
            //                                                             ->join('users', 'users.id', '=', 'empleado_tarea.id')
            //                                                             ->where('fecha_fin', '=', $value)
            //                                                             ->where('users.id', '=', $empleados->valor)
            //                                                             ->get();
            //             $tareas_fecha_limite[] = \DB::table('tarea')    ->join('empleado_tarea', 'empleado_tarea.id_tarea', '                                                   =', 'tarea.id')
            //                                                             ->join('users', 'users.id', '=', 'empleado_tarea.id')
            //                                                             ->where('fecha_limite', '=', $value)
            //                                                             ->where('users.id', '=', $empleados->valor)
            //                                                             ->get();

            //             $empleado = User::find($request->empleados);

            //             //Reinicia los indices del array y acomoda los elementos para que inicien de nuevo en 0 y los junta en un solo array
            //             $resultados = array_merge($tareas_fecha_inicio, $tareas_fecha_fin, $tareas_fecha_limite);

            //             return view('admin.reports.generaReport')->with('empleado', $empleado)->with('resultados', $resultados);
            //         }
            //     }  
            // }
        //} end foreach

        //Elimina del array todos los valores nulos o campos vacios.
        // foreach ($resultados as $clave => $valor) {
        //     if (empty($valor)) unset($resultados[$clave]);
        // }

        // //iguala la variable tareas al array que contiene todas las tareas.
        // array_values($resultados);

        // //$tareas = array_combine(range(1,count($resultados)),  array_values($resultados));

        // $tareas = array();
        //     foreach($resultados as $val){
        //         $tareas[] = $val; //add the value to the new array
        //     };

        // $tareas = array_unshift($resultados, 'blank');
        //             unset($resultados[0]);


        // //Imprime la variable tareas (solo para pruebas)
        // //dd($tareas);

        // $tareas = array_map('array_values', $resultados);

        // $collection = Collection::make($tareas);

        // $collection->all();

        // return view('admin.reports.generaReport')->with('empleado', $empleado)->with('tareas', $collection)->with('request', $request);

        
        

    /*
    /   Aqui termina el codigo donde hemos obtenido todas las tareas que contienen alguna fecha entre el periodo de tiempo
    /   seleccionado
    */





        // if ($request->periodo == 'dia' || $request->campos == 'tareas_finalizadas') {
        //     $tareas = \DB::table('tarea')   ->where('status_tarea', '=', 'finalizada')
        //                                     ->whereBetween('fecha_inicio',[$request->fecha_inicio, $request->fecha_fin])
        //                                     ->whereBetween('fecha_fin', [$request->fecha_inicio, $request->fecha_fin])
        //                                     ->whereBetween('fecha_limite', [$request->fecha_inicio, $request->fecha_fin])
        //                                     ->get();
        // }
        // return view('admin.reports.generaReport');
    }

    public function membersgeneraReport(Request $request)
    {
        $empleado = User::find($request->id_usuario);

        if($request->campos == 'tareas_finalizadas' && $request->periodo =='dia') 
            {
 
                    $tareas_fin_empleado = \DB::select('CALL tareas_fin_usuario_sp('.$request->id_usuario.', "'.$request->fecha_inicio.'", "'.$request->fecha_fin.'")');

                return view('empleado.reports.generaReport')    ->with('request', $request)
                                                                ->with('tareas_fin_empleado', $tareas_fin_empleado)
                                                                ->with('empleado', $empleado);
            }
        elseif($request->campos == 'tareas_finalizadas' && $request->periodo =='mensual') 
            {
                $tareas_fin_mensual = \DB::select   ('CALL tareas_fin_usuario_mes_sp('.$empleado->id.', "'.$request->fecha_inicio.'", "'.$request->fecha_fin.'")');
                $tareas_fin = array_flatten($tareas_fin_mensual);
                return view('empleado.reports.generaReport')->with('request', $request)->with('empleado', $empleado)->with('tareas_fin', $tareas_fin);
            }
        elseif($request->campos == 'tareas_pendientes' && $request->periodo =='dia') 
            {
                    $tareas_pen_empleado = \DB::select('CALL tareas_pen_usuario_sp('.$request->id_usuario.', "'.$request->fecha_inicio.'", "'.$request->fecha_fin.'")');
                $tareas = array_flatten($tareas_pen_empleado);
                return view('empleado.reports.generaReport')->with('request', $request)
                                                            ->with('tareas', $tareas)
                                                            ->with('empleado', $empleado);
            }
        elseif($request->campos == 'tareas_finalizadas_pendientes'  && $request->periodo =='dia' || $request->periodo =='mensual') 
            {
                    $tareas_pen_empleado[] = \DB::select('CALL tareas_pen_usuario_sp('.$request->id_usuario.', "'.$request->fecha_inicio.'", "'.$request->fecha_fin.'")');
                $tareas_pen = array_flatten($tareas_pen_empleado);

                    $tareas_fin_empleado[] = \DB::select('CALL tareas_fin_usuario_sp('.$request->id_usuario.', "'.$request->fecha_inicio.'", "'.$request->fecha_fin.'")');

                $tareas_pen = array_flatten($tareas_pen_empleado);

                $tareas_fin = array_flatten($tareas_fin_empleado);

                array_flatten($tareas_fin_empleado);

                $tareas_fin = array_flatten($tareas_fin_empleado);

                $tareas_total = array_merge($tareas_pen, $tareas_fin);

                return view('empleado.reports.generaReport')->with('request', $request)
                                                            ->with('tareas_total', $tareas_total)
                                                            ->with('tareas_pen_empleado', $tareas_pen)
                                                            ->with('tareas_fin_empleado', $tareas_fin)
                                                            ->with('empleado', $empleado);
            }

    }
}
