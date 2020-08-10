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

Route::group(['middleware' => ['activity']], function () {
    Route::apiResources(
        [
            'ciudadanos' => 'CiudadanosController'
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
Route::get('nucleofamiliar', 'FamiliasController@nucleofamiliar')->name('familias.nucleofamiliar');
Route::group(['middleware' => ['activity']], function () {
    Route::apiResources(
        [
            'familias' => 'FamiliasController'
        ]
    );
});
/*
|--------------------------------------------------------------------------
| Rutas Familias
|--------------------------------------------------------------------------

*/
