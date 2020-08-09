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
Route::put('ciudadanos/{id}/restore', 'CiudadanosController@restore')->name('ciudadanos.restore');
Route::put('ciudadanos/{id}/activar', 'CiudadanosController@activar')->name('ciudadanos.activar');
Route::put('ciudadanos/{id}/inactivar', 'CiudadanosController@inactivar')->name('categorias.inactivar');

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
