<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado_tarea extends Model
{
    protected $table = 'empleado_tarea';

    protected $fillable = ['id', 'id_tarea'];

    public function empleados(){

    	return $this->hasMany('App\User');

    }

    public function tareas(){

    	return $this->hasMany('App\Tarea');

    }

}
