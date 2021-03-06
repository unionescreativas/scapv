<?php

namespace Modules\Caracterizacion\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use Modules\Caracterizacion\Entities\Ciudadano;
use Modules\Caracterizacion\Http\Requests\CiudadanoRequest;

class CiudadanosController extends Controller {

    // Variables Globales---------------------------->
    protected $configModelo;
    protected $modulo;

    public function __construct() {
        $this->configModelo = new Ciudadano;
        $this->modulo = "Ciudadanos";
    }

    // Variables Globales---------------------------->
    public function index(Request $request) {

        // return $usuario;

        $all = DB::table('ciudadanos')->count();
        $length = $request->input('length') == "all" ? $all : $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
        ActivityLogger::activity("Consulto datos del modulo {$this->modulo},Parametros: Cantidad de registros: {$length}, Tipo de Ordenamiento:{$sortBy}, Campo para ordenar:{$orderBy}, Valor a Buscar {$searchValue}-> Metodo Index");
        $variableConsulta = $this->configModelo::eloquentQuery(
            $sortBy,
            $orderBy,
            $searchValue,
            [
                "ayudas", "usuario_creacion", "usuario_actualizacion",
            ]
        )->where('ciudadanos.estado', '1');
        $data = $variableConsulta->paginate($length);
        $ciudadanos = DB::table('ciudadanos')->count();
        return new DataTableCollectionResource($data);
    }

    public function show($id, Request $request) {
        $sortBy = "id";
        $orderBy = "asc";
        $searchValue = $request->input('search');
        $variableConsulta = $this->configModelo::eloquentQuery(
            $sortBy,
            $orderBy,
            $searchValue,
            [
                "ayudas",
            ]
        )->where('ciudadanos.id', $id)->where('ciudadanos.estado', '1');
        $length = 20;
        if ($variableConsulta->first()) {
            $data = $variableConsulta->paginate($length);
            ActivityLogger::activity("Consulto datos del modulo {$this->modulo} para el registro por cedula: {$id}, Valores consultados: {$data} -> Metodo show");
            return new DataTableCollectionResource($data);
        } else {
            $variableConsulta = $this->configModelo::where('numero_documento', $id)->get();
            ActivityLogger::activity("Consulto datos del modulo {$this->modulo} para el registro por cedula: {$id}, Valores consultados: {$variableConsulta} -> Metodo show");
        }
        if ($variableConsulta->isEmpty()) {
            return ['data' => 'no existe', 'status' => '201'];
        }
        return ['data' => $variableConsulta, 'status' => '201'];
    }

    public function validarCampos(CiudadanoRequest $request) {
        return ["data" => ["valid" => true], "status" => "202"];
    }

    public function store(Request $request) {
        $variableConsulta = new Ciudadano;
        $variableConsulta->tipo_documento = $request->tipo_documento;
        $variableConsulta->numero_documento = $request->numero_documento;
        $variableConsulta->pep = $request->pep;
        $variableConsulta->nombres = $request->nombres;
        $variableConsulta->apellidos = $request->apellidos;
        $variableConsulta->fecha_expedicion = $request->fecha_expedicion;
        $variableConsulta->fecha_vencimiento = $request->fecha_vencimiento;
        $variableConsulta->fecha_nacimiento = $request->fecha_nacimiento;
        $variableConsulta->edad = $request->edad;
        $variableConsulta->genero = $request->genero;
        $variableConsulta->estado_civil = $request->estado_civil;
        $variableConsulta->telefono = $request->telefono;
        $variableConsulta->celular = $request->celular;
        $variableConsulta->correo_electronico = $request->correo_electronico;
        $variableConsulta->departamento = $request->departamento;
        $variableConsulta->ciudad = $request->ciudad;
        $variableConsulta->barrio = $request->barrio;
        $variableConsulta->comuna = $request->comuna;
        $variableConsulta->direccion = $request->direccion;
        $variableConsulta->lat = $request->lat;
        $variableConsulta->let = $request->let;
        $variableConsulta->actividad = $request->actividad;
        $variableConsulta->ciudad_origen = $request->ciudad_origen;
        $variableConsulta->pais_origen = $request->pais_origen;
        $variableConsulta->fecha_llegada = $request->fecha_llegada;
        $variableConsulta->intencion_ciudad = $request->intencion_ciudad;
        $variableConsulta->respuesta_intencion = $request->respuesta_intencion;
        $variableConsulta->discapacidad = $request->discapacidad;
        $variableConsulta->salud = $request->salud;
        $variableConsulta->estudia_actualmente = $request->estudia_actualmente;
        $variableConsulta->nivel_escolaridad = $request->nivel_escolaridad;
        $variableConsulta->tipo_profesion = $request->tipo_profesion;
        $variableConsulta->comunidad_lgtbi = $request->comunidad_lgtbi;
        $variableConsulta->comunidad_etnica = $request->comunidad_etnica;
        $variableConsulta->trabajo = $request->trabajo;
        $variableConsulta->tipo_empleo = $request->tipo_empleo;
        $variableConsulta->observaciones = $request->observaciones;
        $variableConsulta->usuario_creacion_id = $request->user()->id;
        $variableConsulta->usuario_actualizacion_id = $request->user()->id;
        $variableConsulta->save();
        ActivityLogger::activity("Guardando datos del modulo {$this->modulo}, Datos Guardaros:{$variableConsulta}, -> Metodo Store.");
        return ['data' => $variableConsulta, 'status' => '202'];
    }

    public function update(Request $request, $id) {
        //
        $datosAnteriores = $this->configModelo::find($id);
        $variableConsulta = $this->configModelo::find($id);
        $variableConsulta->tipo_documento = $request->tipo_documento;
        $variableConsulta->numero_documento = $request->numero_documento;
        $variableConsulta->pep = $request->pep;
        $variableConsulta->nombres = $request->nombres;
        $variableConsulta->apellidos = $request->apellidos;
        $variableConsulta->fecha_expedicion = $request->fecha_expedicion;
        $variableConsulta->fecha_vencimiento = $request->fecha_vencimiento;
        $variableConsulta->fecha_nacimiento = $request->fecha_nacimiento;
        $variableConsulta->edad = $request->edad;
        $variableConsulta->genero = $request->genero;
        $variableConsulta->estado_civil = $request->estado_civil;
        $variableConsulta->telefono = $request->telefono;
        $variableConsulta->celular = $request->celular;
        $variableConsulta->correo_electronico = $request->correo_electronico;
        $variableConsulta->departamento = $request->departamento;
        $variableConsulta->ciudad = $request->ciudad;
        $variableConsulta->barrio = $request->barrio;
        $variableConsulta->comuna = $request->comuna;
        $variableConsulta->direccion = $request->direccion;
        $variableConsulta->lat = $request->lat;
        $variableConsulta->let = $request->let;
        $variableConsulta->actividad = $request->actividad;
        $variableConsulta->ciudad_origen = $request->ciudad_origen;
        $variableConsulta->pais_origen = $request->pais_origen;
        $variableConsulta->fecha_llegada = $request->fecha_llegada;
        $variableConsulta->intencion_ciudad = $request->intencion_ciudad;
        $variableConsulta->respuesta_intencion = $request->respuesta_intencion;
        $variableConsulta->discapacidad = $request->discapacidad;
        $variableConsulta->salud = $request->salud;
        $variableConsulta->estudia_actualmente = $request->estudia_actualmente;
        $variableConsulta->nivel_escolaridad = $request->nivel_escolaridad;
        $variableConsulta->tipo_profesion = $request->tipo_profesion;
        $variableConsulta->comunidad_lgtbi = $request->comunidad_lgtbi;
        $variableConsulta->comunidad_etnica = $request->comunidad_etnica;
        $variableConsulta->trabajo = $request->trabajo;
        $variableConsulta->tipo_empleo = $request->tipo_empleo;
        $variableConsulta->observaciones = $request->observaciones;
        $variableConsulta->usuario_actualizacion_id = $request->user()->id;
        $variableConsulta->save();
        ActivityLogger::activity("Actualizando datos del modulo {$this->modulo},  Datos Anteriores:{$datosAnteriores}  Datos Nuevos:{$variableConsulta}, para el registro id {$id} ->Metodo Update.");
        return ['data' => $variableConsulta, 'status' => '203'];
    }

    public function destroy($id) {
        $variableConsulta = $this->configModelo::find($id);
        $datosElimnados = $variableConsulta;
        $ciudadano = DB::table('familias')->where('ciudadano_id', $id)->delete();
        $ciudadano = DB::table('ayudas')->where('ciudadano_id', $id)->delete();
        $variableConsulta = $this->configModelo::find($id)->forceDelete();

        ActivityLogger::activity("Eliminado Registo Modulo {$this->modulo},Datos eliminados:{$datosElimnados},  para el registro {$id} -> Metodo destroy");
        return ['data' => $variableConsulta, 'status' => '204'];

        // $variableConsulta = $this->configModelo::find($id);
        // $datosElimnados = $variableConsulta;
        // $variableConsulta->usuario_actualizacion_id = $request->user()->id;
        // $variableConsulta = $this->configModelo::destroy($id);
        // ActivityLogger::activity("Eliminado Registo Modulo {$this->modulo},Datos eliminados:{$datosElimnados},  para el registro {$id} -> Metodo destroy");
        // return ['data' => $variableConsulta, 'status' => '204'];
    }

    public function activar($id) {
        $variableConsulta = $this->configModelo::find($id);
        $datosActivar = $variableConsulta;
        $variableConsulta->usuario_actualizacion_id = $request->user()->id;
        ActivityLogger::activity("Activando Registo Modulo {$this->modulo},Datos Activar: {$datosActivar}, para el registro {$id} -> Metodo Activar.");
        $variableConsulta->estado = 1;
        $variableConsulta->save();
        return ['data' => $variableConsulta, 'status' => '205'];
    }

    public function inactivar($id) {
        $variableConsulta = $this->configModelo::find($id);
        $datosActivar = $variableConsulta;
        $variableConsulta->usuario_actualizacion_id = $request->user()->id;
        ActivityLogger::activity("Inactivando Registo Modulo {$this->modulo},Datos Inactivar: {$datosActivar}, para el registro {$id} -> Metodo Inactivar.");
        $variableConsulta->estado = 0;
        $variableConsulta->save();
        return ['data' => $variableConsulta, 'status' => '206'];
    }

    public function restore($id) {
        $variableConsulta = $this->configModelo::withTrashed()->find($id);
        $datosRestaurar = $variableConsulta;
        ActivityLogger::activity("Restaurando Registo Modulo {$this->modulo},Datos a Restaurar: {$datosRestaurar}, para el registro {$id} -> Metodo Restaurar.");
        $variableConsulta->restore();
        return ['data' => $variableConsulta, 'status' => '207'];
    }

    public function buscadogeneral() {
        $user = $this->configModelo::all();

        return $user->toArray();
    }
}
