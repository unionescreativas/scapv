<?php

namespace Modules\Caracterizacion\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Caracterizacion\Entities\Familia;
use Modules\Caracterizacion\Http\Requests\FamiliaRequest;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class FamiliasController extends Controller {

    protected $configModelo;
    protected $modulo;

    public function __construct() {
        // Variables Globales---------------------------->
        $this->configModelo = new Familia;
        $this->modulo = "Familias";
        // Variables Globales---------------------------->

    }

    public function index(Request $request) {
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
        ActivityLogger::activity("Consulto datos del modulo {$this->modulo},Parametros: Cantidad de registros: {$length}, Tipo de Ordenamiento:{$sortBy}, Campo para ordenar:{$orderBy}, Valor a Buscar {$searchValue}-> Metodo Index");
        $variableConsulta = $this->configModelo::eloquentQuery($sortBy, $orderBy, $searchValue, [
            "ciudadano",
        ])->where('familias.estado', '1');
        $data = $variableConsulta->paginate($length);
        return new DataTableCollectionResource($data);
    }
    public function nucleofamiliar(Request $request, $id) {
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
        ActivityLogger::activity("Consulto datos del modulo {$this->modulo},Parametros: Cantidad de registros: {$length}, Tipo de Ordenamiento:{$sortBy}, Campo para ordenar:{$orderBy}, Valor a Buscar {$searchValue}-> Metodo Index");
        $variableConsulta = $this->configModelo::eloquentQuery($sortBy, $orderBy, $searchValue, [
            "ciudadano",
        ])->where('ciudadano_id', $id)
            ->where('familias.estado', '1');
        $data = $variableConsulta->paginate($length);
        return new DataTableCollectionResource($data);
    }
    public function show($id) {
        $variableConsulta = $this->configModelo::where('id', $id)->where('estado', '1')->get();

        // if ($variableConsulta->isEmpty()) {
        //     $variableConsulta = $this->configModelo::where('numero_documento', $id)->get();
        //     ActivityLogger::activity("Consulto datos del modulo {$this->modulo} para el registro por cedula: {$id}, Valores consultados: {$variableConsulta} -> Metodo show");
        // } else {
        //     ActivityLogger::activity("Consulto datos del modulo {$this->modulo} para el registro con id: {$id},  Valores consultados: {$variableConsulta} -> Metodo show");
        // }
        // if ($variableConsulta->isEmpty()) {
        //     return ['data' => 'no existe', 'status' => '201'];
        // }

        return ['data' => $variableConsulta, 'status' => '201'];
    }
    public function store(FamiliaRequest $request) {

        $variableConsulta = $this->configModelo;

        //Campos a guardar aquí--------------->
        $variableConsulta->ciudadano_id = $request->ciudadano_id;
        $variableConsulta->parentesco = $request->parentesco;
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
        // $variableConsulta->departamento = $request->departamento;
        // $variableConsulta->ciudad = $request->ciudad;
        // $variableConsulta->barrio = $request->barrio;
        // $variableConsulta->comuna = $request->comuna;
        // $variableConsulta->direccion = $request->direccion;
        $variableConsulta->actividad = $request->actividad;
        // $variableConsulta->ciudad_origen = $request->ciudad_origen;
        // $variableConsulta->pais_origen = $request->pais_origen;
        // $variableConsulta->fecha_llegada = $request->fecha_llegada;
        // $variableConsulta->intencion_ciudad = $request->intencion_ciudad;
        // $variableConsulta->respuesta_intencion = $request->respuesta_intencion;
        $variableConsulta->discapacidad = $request->discapacidad;
        $variableConsulta->salud = $request->salud;
        $variableConsulta->estudia_actualmente = $request->estudia_actualmente;
        $variableConsulta->nivel_escolaridad = $request->nivel_escolaridad;
        // $variableConsulta->tipo_profesion = $request->tipo_profesion;
        // $variableConsulta->comunidad_lgtbi = $request->comunidad_lgtbi;
        // $variableConsulta->comunidad_etnica = $request->comunidad_etnica;
        $variableConsulta->trabajo = $request->trabajo;
        // $variableConsulta->tipo_empleo = $request->tipo_empleo;
        $variableConsulta->observaciones = $request->observaciones;
        //Campos a guardar aquí--------------->

        $variableConsulta->save();
        ActivityLogger::activity("Guardando datos del modulo {$this->modulo}, Datos Guardaros:{$variableConsulta}, -> Metodo Store.");
        return ['data' => $variableConsulta, 'status' => '202'];
    }
    public function update(FamiliaRequest $request, $id) {
        //
        $datosAnteriores = $this->configModelo::find($id);
        $variableConsulta = $this->configModelo::find($id);

        //Campos Actualizar aquí--------------->
        $variableConsulta->ciudadano_id = $request->ciudadano_id;
        $variableConsulta->parentesco = $request->parentesco;
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
        $variableConsulta->actividad = $request->actividad;
        $variableConsulta->ciudad_origen = $request->ciudad_origen;
        $variableConsulta->pais_origen = $request->pais_origen;
        $variableConsulta->fecha_llegada = $request->fecha_llegada;
        $variableConsulta->intencion_ciudad = $request->intencion_ciudad;
        $variableConsulta->respuesta_intencion = $request->respuesta_intencion;
        $variableConsulta->fecha_llegada = $request->fecha_llegada;
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
        //Campos Actualizar aquí--------------->

        $variableConsulta->save();
        ActivityLogger::activity("Actualizando datos del modulo {$this->modulo},  Datos Anteriores:{$datosAnteriores}  Datos Nuevos:{$variableConsulta}, para el registro id {$id} ->Metodo Update.");
        return ['data' => $variableConsulta, 'status' => '203'];
    }
    public function destroy($id) {
        $variableConsulta = $this->configModelo::find($id);
        $datosElimnados = $variableConsulta;
        $variableConsulta = $this->configModelo::destroy($id);
        ActivityLogger::activity("Eliminado Registo Modulo {$this->modulo},Datos eliminados:{$datosElimnados},  para el registro {$id} -> Metodo destroy");
        return ['data' => $variableConsulta, 'status' => '204'];
    }

    public function activar($id) {
        $variableConsulta = $this->configModelo::find($id);
        $datosActivar = $variableConsulta;
        ActivityLogger::activity("Activando Registo Modulo {$this->modulo},Datos Activar: {$datosActivar}, para el registro {$id} -> Metodo Activar.");
        $variableConsulta->estado = 1;
        $variableConsulta->save();
        return ['data' => $variableConsulta, 'status' => '205'];
    }

    public function inactivar($id) {
        $variableConsulta = $this->configModelo::find($id);
        $datosActivar = $variableConsulta;
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
}
