<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTareaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarea', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('prioridad_tarea', ['alta', 'media', 'baja'])->default('baja');
            $table->enum('status_tarea', ['finalizada', 'pendiente'])->default('pendiente');
            $table->string('nombre_tarea');
            $table->string('descripcion_tarea');
            $table->date('fecha_inicio');
            $table->date('fecha_limite');
            $table->date('fecha_fin');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tarea');
    }
}
