<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/reportes', function (Request $request) {
    return $request->user();
});

Route::get('reportes/ciudadanos/', 'GenerarReportesController@exportarCiudadanos');
Route::get('reportes/familias/', 'GenerarReportesController@exportarFamilias');
Route::get('reportes/ayudasentregadas/', 'GenerarReportesController@exportarAyudas');
Route::get('reportes/ayudaspendientes/', 'GenerarReportesController@exportarAyudasPendientes');


