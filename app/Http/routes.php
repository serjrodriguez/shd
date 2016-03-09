<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Ruta de inicio

	Route::get('/', ['as' => '/', function () {
    return view('auth.login');
	}]);


//Grupo de rutas para el administrador

	Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function(){

		Route::get('/', ['as' => 'inicio', function () {
	    	return redirect()->route('admin.users.index');
		}]);

//Rutas para el modulo de usuarios en el panel del administrador

	Route::resource('users', 'UsersController');

	Route::get('users/{id}/destroy', [

		'uses' => 'UsersController@destroy',
		'as' => 'admin.users.destroy'

	]);

	Route::get('users/{id}/detalles', [

		'uses' => 'UsersController@detalles',
		'as' => 'admin.users.detalles'

	]);

//Rutas para el modulo de tareas en el panel del administrador

	Route::resource('tareas', 'TareasController');

	Route::get('misasignaciones', [

		'uses' 	=> 'TareasController@asignacionesAdmin',
		'as'	=> 'admin.tareas.asignaciones'

		]);

	Route::get('tareas/{id}/destroy', [

		'uses' => 'TareasController@destroy',
		'as' => 'admin.tareas.destroy'

	]);

	Route::get('tareas/{id}/detalles', [

		'uses' => 'TareasController@detalles',
		'as' => 'admin.tareas.detalles'

	]);

	Route::get('tareas/{id}/asignar/',[

		'uses' 	=> 'TareasController@asignar',
		'as' 	=> 'admin.tareas.asignar'

	]);

	Route::get('tareas/{id}/generaPDF',[

		'uses' 	=> 'TareasController@generaPDF',
		'as' 	=> 'admin.tareas.generaPDF'

	]);

	Route::post('tareas/{id}/saveasign',[

		'uses' 	=> 'TareasController@saveasign',
		'as' 	=> 'admin.tareas.saveasign'

	]);

//Rutas para el modulo de reportes en el panel del administrador

	Route::resource('reportes', 'ReportController');

	Route::get('estadisticas',[

			'uses' => 'ReportController@muestaEstadistica',
			'as' => 'admin.reports.stadistics'

		]);

	Route::get('generador',[

		'uses' => 'ReportController@generator',
		'as' => 'admin.reports.generator'

		]);

	Route::post('reportes',[

		'uses' => 'ReportController@generaReport',
		'as' => 'admin.reports.genera'

		]);


//Aqui terminan las rutas el modulo de reportes.

}); //aqui termina el grupo de rutas para el admin

//Aqui comienza el grupo de rutas para los empleados

	Route::group(['prefix' => 'members', 'middleware' => 'auth'], function(){

		Route::get('/', ['as' => 'inicio', function () {
	    	return redirect()->route('members.tareas.index');
		}]);

		Route::resource('tareas', 'MembersController');

			Route::get('tareas/{id}/detalles', [

			'uses' => 'TareasController@detallesMembers',
			'as' => 'members.tareas.detalles'

		]);

		Route::get('tareas/{id}/destroy', [

			'uses' => 'TareasController@destroy',
			'as' => 'members.tareas.destroy'

		]);

		Route::get('tareas/{id}/generaPDF',[

			'uses' 	=> 'TareasController@generaPDF',
			'as' 	=> 'members.tareas.generaPDF'

		]);

		Route::get('tareas/{id}/editmembers',[

			'uses' 	=> 'TareasController@editmembers',
			'as' 	=> 'members.tareas.editmembers'

		]);

		Route::put('tareas/{id}/updatemembers',[

			'uses' 	=> 'TareasController@updatemembers',
			'as' 	=> 'members.tareas.updatemembers'

		]);

	//Rutas para el modulo de reportes en el panel de usuarios

	Route::get('index',[

			'uses' => 'ReportController@reportsIndexMembers',
			'as' => 'members.reports.index'

		]);

	Route::get('estadisticas',[

			'uses' => 'ReportController@muestaEstadistica',
			'as' => 'members.reports.stadistics'

		]);

	Route::get('generador',[

		'uses' => 'ReportController@membersgenerator',
		'as' => 'members.reports.membersgenerator'

		]);

	Route::post('reportes',[

		'uses' => 'ReportController@membersgeneraReport',
		'as' => 'empleado.reports.genera'

		]);

	});


//Rutas para la autenticacion de usuarios (login)

Route::get('auth/login', [

	'uses'	=> 	'Auth\AuthController@getLogin',
	'as'	=>	'auth.login'

	]);

Route::post('auth/login', [

	'uses'	=> 	'Auth\AuthController@postLogin',
	'as'	=>	'auth.login'

	]);

Route::get('admin/auth/logout', [

	'uses'	=> 	'Auth\AuthController@getLogout',
	'as'	=>	'auth.logout'

	]); //aqui terminan las rutas para la autenticacion de usuarios