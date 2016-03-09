<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Tarea extends Model
{
    protected $table = 'tarea';

    protected $fillable = ['status_tarea', 'prioridad_tarea', 'nombre_tarea', 'descripcion_tarea', 'fecha_inicio', 'fecha_limite', 'fecha_fin'];
    
    public function empleado_tarea(){

    	return $this->belongsTo('App\Empleado_tarea');

    }

    public function scopeSearchTarea($query, $name){

        return $query->where('nombre_tarea', 'LIKE', "%$name%");

    }
}
