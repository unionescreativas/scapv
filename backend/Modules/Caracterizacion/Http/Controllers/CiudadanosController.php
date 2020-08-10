<?php

namespace Modules\Caracterizacion\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Caracterizacion\Entities\Ciudadano;
use Modules\Caracterizacion\Transformers\CiudadanoResource;
use Modules\Caracterizacion\Transformers\CiudadanoCollection;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
class CiudadanosController extends Controller
{
    use ActivityLogger;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        ActivityLogger::activity("Consulto datos del modulo ciudadanos");
        // $query = Ciudadano::aplicarFilter();
        $ciudadanos =CiudJamesDordoy\LaravelVueDatatable\Providers\LaravelVueDatatableServiceProvider::class,
        adano::aplicarOrden()
            ->paginacion();

        return CiudadanoCollection::make($ciudadanos);
    }

    public function show(Ciudadano $ciudadano)
    {
        return CiudadanoResource::make($ciudadano);
    }


    public function store(Request $request)
    {
        //

        $ciudadanos = new Ciudadano;
        $ciudadanos->tipo_documento = $request->tipo_documento;
        $ciudadanos->numero_documento = $request->numero_documento;
        $ciudadanos->pep = $request->pep;
        $ciudadanos->nombres = $request->nombres;
        $ciudadanos->apellidos = $request->apellidos;
        $ciudadanos->fecha_expedicion = $request->fecha_expedicion;
        $ciudadanos->fecha_vencimiento = $request->fecha_vencimiento;
        $ciudadanos->fecha_nacimiento = $request->fecha_nacimiento;
        $ciudadanos->edad = $request->edad;
        $ciudadanos->genero = $request->genero;
        $ciudadanos->estado_civil = $request->estado_civil;
        $ciudadanos->telefono = $request->telefono;
        $ciudadanos->celular = $request->celular;
        $ciudadanos->correo_electronico = $request->correo_electronico;
        $ciudadanos->departamento = $request->departamento;
        $ciudadanos->ciudad = $request->ciudad;
        $ciudadanos->barrrio = $request->barrrio;
        $ciudadanos->comuna = $request->comuna;
        $ciudadanos->dirrecion = $request->dirrecion;
        $ciudadanos->lat = $request->lat;
        $ciudadanos->let = $request->let;
        $ciudadanos->actividad = $request->actividad;
        $ciudadanos->ciudad_origen = $request->ciudad_origen;
        $ciudadanos->pais_origen = $request->pais_origen;
        $ciudadanos->fecha_llegada = $request->fecha_llegada;
        $ciudadanos->intencion_ciudad = $request->intencion_ciudad;
        $ciudadanos->respuesta_intencion = $request->respuesta_intencion;
        $ciudadanos->discapacidad = $request->discapacidad;
        $ciudadanos->salud = $request->salud;
        $ciudadanos->estudia_actualmente = $request->estudia_actualmente;
        $ciudadanos->nivel_escolaridad = $request->nivel_escolaridad;
        $ciudadanos->tipo_profesion = $request->tipo_profesion;
        $ciudadanos->comunidad_lgtbi = $request->comunidad_lgtbi;
        $ciudadanos->comunidad_etnica = $request->comunidad_etnica;
        $ciudadanos->trabajo = $request->trabajo;
        $ciudadanos->tipo_empleo = $request->tipo_empleo;
        $ciudadanos->observaciones = $request->observaciones;
        $ciudadanos->save();
        return ['data' => $ciudadanos, 'status' => '201'];
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('caracterizacion::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
