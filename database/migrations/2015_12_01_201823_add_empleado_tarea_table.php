<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmpleadoTareaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_tarea', function (Blueprint $table) {
            $table->increments('id_empleado_tarea');
            $table->integer('id')->unsigned();
            $table->integer('id_tarea')->unsigned();

            $table->foreign('id')->references('id')->on('users');
            $table->foreign('id_tarea')->references('id')->on('tarea');

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
        Schema::drop('empleado_tarea');
    }
}
