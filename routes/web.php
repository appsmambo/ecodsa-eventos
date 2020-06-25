<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('asociaciones')->group(function () {
    Route::get('/', 'AsociacionController@getIndex')->name('asociacion.index');
    Route::post('/buscar', 'AsociacionController@postSearch')->name('asociacion.buscar');
    Route::get('/nuevo', 'AsociacionController@getNuevo')->name('asociacion.nuevo');
    Route::get('/editar/{id}', 'AsociacionController@getEditar')->name('asociacion.editar');
    Route::post('/grabar', 'AsociacionController@postGrabar')->name('asociacion.grabar');
});

Route::prefix('eventos')->group(function () {
    Route::get('/', 'EventoController@getIndex')->name('evento.index');
    Route::post('/buscar', 'EventoController@postSearch')->name('evento.buscar');
    Route::get('/nuevo', 'EventoController@getNuevo')->name('evento.nuevo');
    Route::get('/editar/{id}', 'EventoController@getEditar')->name('evento.editar');
    Route::post('/grabar', 'EventoController@postGrabar')->name('evento.grabar');
});

Route::prefix('participantes')->group(function () {
    Route::get('/', 'ParticipanteController@getIndex')->name('participante.index');
    Route::post('/buscar', 'ParticipanteController@postSearch')->name('participante.buscar');
    Route::get('/nuevo', 'ParticipanteController@getNuevo')->name('participante.nuevo');
    Route::get('/editar/{id}', 'ParticipanteController@getEditar')->name('participante.editar');
    Route::post('/grabar', 'ParticipanteController@postGrabar')->name('participante.grabar');
});

Route::prefix('asistencia')->group(function () {
    Route::get('/', 'AsistenciaController@getIndex')->name('asistencia.index');
    Route::post('/buscar', 'AsistenciaController@postSearch')->name('asistencia.buscar');
    Route::get('/buscar', 'AsistenciaController@postSearch')->name('asistencia.buscar');
    Route::post('/grabar', 'AsistenciaController@postGrabar')->name('asistencia.grabar');
});

Route::prefix('usuarios')->group(function () {
    Route::get('/', 'UsuarioController@getIndex')->name('usuario.index');
    Route::post('/buscar', 'UsuarioController@postSearch')->name('usuario.buscar');
    Route::get('/nuevo', 'UsuarioController@getNuevo')->name('usuario.nuevo');
    Route::get('/editar/{id}', 'UsuarioController@getEditar')->name('usuario.editar');
    Route::post('/grabar', 'UsuarioController@postGrabar')->name('usuario.grabar');
});

Route::prefix('paises')->group(function () {
    Route::post('/buscarEstados', 'PaisController@postBuscarEstados');
});

Route::get('storage/images/{filename}', function ($filename)
{
    $path = storage_path('app/images/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
