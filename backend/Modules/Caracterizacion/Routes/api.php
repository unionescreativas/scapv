<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/caracterizacion', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| Rutas Ciudadanos
|--------------------------------------------------------------------------

 */
Route::put('ciudadanos/{id}/inactivar', 'CiudadanosController@inactivar')->name('ciudadanos.inactivar');
Route::put('ciudadanos/{id}/activar', 'CiudadanosController@activar')->name('ciudadanos.activar');
Route::put('ciudadanos/{id}/restore', 'CiudadanosController@restore')->name('ciudadanos.restore');
Route::post('ciudadanosvalidar', 'CiudadanosController@validarCampos')->name('ciudadanos.validarCampos');
Route::post('buscadorgeneral', 'CiudadanosController@buscadogeneral')->name('ciudadanos.buscadogeneral');

Route::group(['middleware' => ['activity']], function () {
    Route::apiResources(
        [
            'ciudadanos' => 'CiudadanosController',
        ]
    );
});
/*
|--------------------------------------------------------------------------
| Rutas Ciudadanos
|--------------------------------------------------------------------------

 */

/*
|--------------------------------------------------------------------------
| Rutas Familias
|--------------------------------------------------------------------------

 */
Route::put('familias/{id}/inactivar', 'FamiliasController@inactivar')->name('familias.inactivar');
Route::put('familias/{id}/activar', 'FamiliasController@activar')->name('familias.activar');
Route::put('familias/{id}/restore', 'FamiliasController@restore')->name('familias.restore');
Route::get('nucleofamiliar/{id}', 'FamiliasController@nucleofamiliar')->name('familias.nucleofamiliar');
Route::group(['middleware' => ['activity']], function () {
    Route::apiResources(
        [
            'familias' => 'FamiliasController',
        ]
    );
});
/*
|--------------------------------------------------------------------------
| Rutas Familias
|--------------------------------------------------------------------------

 */

/*
|--------------------------------------------------------------------------
| Rutas Listas
|--------------------------------------------------------------------------

 */
Route::put('listas/{id}/inactivar', 'ListasController@inactivar')->name('listas.inactivar');
Route::put('listas/{id}/activar', 'ListasController@activar')->name('listas.activar');
Route::put('listas/{id}/restore', 'ListasController@restore')->name('listas.restore');
Route::group(['middleware' => ['activity']], function () {
    Route::apiResources(
        [
            'listas' => 'ListasController',
        ]
    );
});
/*
|--------------------------------------------------------------------------
| Rutas Listas
|--------------------------------------------------------------------------

 */

/*
|--------------------------------------------------------------------------
| Rutas Transeferencias
|--------------------------------------------------------------------------

 */
Route::put('transferencias/{id}/inactivar', 'TransferenciasController@inactivar')->name('transferencias.inactivar');
Route::put('transferencias/{id}/activar', 'TransferenciasController@activar')->name('transferencias.activar');
Route::put('transferencias/{id}/restore', 'TransferenciasController@restore')->name('transferencias.restore');
Route::group(['middleware' => ['activity']], function () {
    Route::apiResources(
        [
            'transferencias' => 'TransferenciasController',
        ]
    );
});
/*
|--------------------------------------------------------------------------
| Rutas Transeferencias
|--------------------------------------------------------------------------

 */

/*
|--------------------------------------------------------------------------
| Rutas Documentos----------------->
|--------------------------------------------------------------------------

 */
Route::put('documentos/{id}/inactivar', 'DocumentosController@inactivar')->name('documentos.inactivar');
Route::put('documentos/{id}/activar', 'DocumentosController@activar')->name('documentos.activar');
Route::put('documentos/{id}/restore', 'DocumentosController@restore')->name('documentos.restore');
Route::group(['middleware' => ['activity']], function () {
    Route::apiResources(
        [
            'documentos' => 'DocumentosController',
        ]
    );
});
/*
|--------------------------------------------------------------------------
| Rutas Documentos----------------->
|--------------------------------------------------------------------------

 */

/*
|--------------------------------------------------------------------------
| Rutas Ayudas----------------->
|--------------------------------------------------------------------------

 */
Route::put('ayudas/{id}/inactivar', 'AyudasController@inactivar')->name('ayudas.inactivar');
Route::put('ayudas/{id}/activar', 'AyudasController@activar')->name('ayudas.activar');
Route::put('ayudas/{id}/restore', 'AyudasController@restore')->name('ayudas.restore');
Route::get('consultandounidades/{ciudadano_id}/{lista_id}/{cantidad}', 'AyudasController@consultandounidades')->name('ayudas.consultandounidades');
Route::group(['middleware' => ['activity']], function () {
    Route::apiResources(
        [
            'ayudas' => 'AyudasController',
        ]
    );
});
/*
|--------------------------------------------------------------------------
| Rutas Ayudas----------------->
|--------------------------------------------------------------------------

 */
