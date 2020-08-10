<?php

namespace Modules\Caracterizacion\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Caracterizacion\Entities\Ciudadano;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class CiudadanosController extends Controller
{
    use ActivityLogger;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        ActivityLogger::activity("Consulto datos del modulo ciudadanos, Metodo Index");
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
        $query = Ciudadano::eloquentQuery($sortBy, $orderBy, $searchValue);
        $data = $query->paginate($length);
        return new DataTableCollectionResource($data);
    }

    public function show($id)
    {
        ActivityLogger::activity("Consulto datos del modulo ciudadanos para el registro: {$id}, Metodo show");
        $ciudadano = Ciudadano::where('id', $id)->get();
        if (is_null($ciudadano)) {
            $ciudadano = Ciudadano::where('numero_documento', $id);
            if (is_null($ciudadano)) {
                return ['data' => "no existe", 'status' => '200'];
            } else {
                return ['data' => $ciudadano, 'status' => '201'];
            }
        } else {
            return ['data' => $ciudadano, 'status' => '201'];
        }
    }


    public function store(Request $request)
    {

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
        ActivityLogger::activity("Guardando datos del modulo ciudadanos, Metodo Store. Datos :{$ciudadanos}");
        return ['data' => $ciudadanos, 'status' => '201'];
    }
    public function update(Request $request, $id)
    {
        //
        $ciudadanos = Ciudadano::find($id);
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
        ActivityLogger::activity("Actualizando datos del modulo ciudadanos, Metodo Update. Datos :{$ciudadanos}, para el registro id {$id}");
        return ['data' => $ciudadanos, 'status' => '202'];
    }
    public function destroy($id)
    {
        $ciudadanos = Ciudadano::destroy($id);
        ActivityLogger::activity("Eliminado Registo Modulo ciudadanos, Metodo destroy {$id}");
        return ['data' => $ciudadanos, 'status' => '203'];

        //
    }

    public function inactivar($id)
    {
        ActivityLogger::activity("Inactivando Registo Modulo ciudadanos, Metodo inactivar {$id}");
        $ciudadanos = Ciudadano::find($id);
        $ciudadanos->estado = 0;
        $ciudadanos->save();
        return ['data' => $ciudadanos, 'status' => '202'];

        //
    }
    public function activar($id)
    {
        ActivityLogger::activity("Activando Registo Modulo ciudadanos, Metodo activar {$id}");
        $ciudadanos = Ciudadano::find($id);
        $ciudadanos->restore();
        return ['data' => $ciudadanos, 'status' => '202'];

        //
    }
    public function restore($id)
    {
        ActivityLogger::activity("Recuperando Registro Borrado  Modulo ciudadanos, Metodo restore {$id}");
        $ciudadanos = Ciudadano::withTrashed()->find($id);
        $ciudadanos->deleted_at = null;
        $ciudadanos->save();
        return ['data' => $ciudadanos, 'status' => '202'];

        //
    }
}
