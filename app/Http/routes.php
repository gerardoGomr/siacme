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

// Authentication routes...
Route::get('login', 'Usuarios\LoginController@index');
Route::post('login', 'Usuarios\LoginController@logueo');
Route::get('logout', 'Usuarios\LoginController@logout');

// aplicacion
Route::group(['middleware' => 'checaLogin'], function() {
	// pagina principal
	Route::get('/', 'PrincipalController@index');

	/////////////////////////////////////////// CITAS /////////////////////////////////////////////////////
	// pagina principal
	Route::get('citas/{med}', 'Citas\CitasController@index');
	// ver eventos
	Route::get('citas/citas/{med}', 'Citas\CitasController@verCitas');
	// ver formulario de alta
	Route::get('citas/agregar/{fecha}/{hora}/{med}', 'Citas\CitasController@agregar');
	// guardar cita
	Route::post('citas/agregar', 'Citas\CitasController@guardar');
	// verificar que exista un expediente
	Route::post('citas/verifica', 'Citas\CitasController@comprobarPaciente');
	// ver detalles de una cita
	Route::get('citas/detalle/{id}/{medico}', 'Citas\CitasController@verDetalle');
	// ver formulario de editar
	Route::get('citas/editar/{id}', 'Citas\CitasController@editar');
	// actualizar cita
	Route::post('citas/actualizar', 'Citas\CitasController@actualizar');
	// modificar estatus de cita
	Route::post('citas/estatus', 'Citas\CitasController@estatus');
	// seleccion de reprogramar
	Route::post('citas/guardaEnSesion', 'Citas\CitasController@guardaEnSesion');
	// acción de reprogramar
	Route::post('citas/reprogramar', 'Citas\CitasController@reprogramar');
	///////////////////////////////////////////////////////////////////////////////////////////////////////

	/////////////////////////////////////////// EXPEDIENTES //////////////////////////////////////////////
	// abrir formulario de captura
	Route::get('expedientes/agregar/odont/{id}/{med}', 'Expedientes\ExpedienteController@index');
	// abrir pantalla de vista previa
	Route::get('expedientes/ver/odont/{id}/{med}', 'Expedientes\ExpedienteController@ver');
	// guardar / editar expediente
	Route::post('expedientes/agregarEditar', 'Expedientes\ExpedienteController@agregarEditarExpediente');
	// firmar expediente
	Route::post('expedientes/firmar/odont', 'Expedientes\ExpedienteController@firmar');
	// subir foto
	Route::post('expedientes/subir/foto', 'Expedientes\ExpedienteController@subirFoto');
	//recortar foto
	Route::post('expedientes/recortar/foto', 'Expedientes\ExpedienteController@recortarFoto');
	//abrir camara
	Route::get('expedientes/foto/camara/{id}/{med}', 'Expedientes\ExpedienteController@camara');
	// guardar foto capturada por camara
	Route::post('expedientes/foto/camara/{id}/{med}', 'Expedientes\ExpedienteController@capturarFoto');

	/////////////////////////////////////////// CONSULTAS //////////////////////////////////////////////
	// principal consultas
	Route::get('consultas/{medico}', 'ConsultasController\ConsultasController@index');
	// buscar citas por dia
	Route::post('consultas/verCitas', 'ConsultasController\ConsultasController@verCitasDelDia');
	// ver detalle de una cita
	Route::post('consultas/citaDetalle', 'ConsultasController\ConsultasController@citaDetalle');
	// abrir pantalla de captura de consulta
	Route::get('consultas/capturar/{id1}/{id2}', 'ConsultasController\ConsultasController@capturar');
	// abrir pantalla de selección de estatus, pasando el número de diente
	Route::get('consultas/odontograma/estatus/{id}', 'ConsultasController\ConsultasController@seleccionEstatus');
	// guardar estatus para el odontograma
	Route::post('consultas/odontograma/estatus/asignar', 'ConsultasController\ConsultasController@asignarEstatusDental');
	// pintar odontograma
	Route::post('consultas/odontograma/dibujar', 'ConsultasController\ConsultasController@dibujar');
	// ventana recetas
	Route::get('consultas/receta/agregar', 'ConsultasController\ConsultasController@capturaReceta');
});