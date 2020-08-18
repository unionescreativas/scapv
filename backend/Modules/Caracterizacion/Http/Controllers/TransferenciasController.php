<?php

namespace Modules\Caracterizacion\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use Modules\Caracterizacion\Entities\Ciudadano;
use Modules\Caracterizacion\Entities\Familia;
use Modules\Caracterizacion\Entities\Transferencia;

class TransferenciasController extends Controller {

    protected $configModelo;
    protected $modulo;

    public function __construct() {
        // Variables Globales---------------------------->
        $this->configModelo = new Transferencia;
        $this->modulo = "Transferencias";
        // Variables Globales---------------------------->

    }

    public function index(Request $request) {
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
        ActivityLogger::activity("Consulto datos del modulo {$this->modulo},Parametros: Cantidad de registros: {$length}, Tipo de Ordenamiento:{$sortBy}, Campo para ordenar:{$orderBy}, Valor a Buscar {$searchValue}-> Metodo Index");
        $variableConsulta = $this->configModelo::eloquentQuery(
            $sortBy,
            $orderBy,
            $searchValue,
            [
                "familia", "ciudadano",
            ]
        )->where('transferencias.estado', '1');
        $data = $variableConsulta->paginate($length);
        return new DataTableCollectionResource($data);
    }
    public function show($id) {
        $variableConsulta = $this->configModelo::where('id', $id)->where('transferencias.estado', '1')->get();

        if ($variableConsulta->isEmpty()) {
            $variableConsulta = $this->configModelo::where('ciudadano_id', $id)->get();
            ActivityLogger::activity("Consulto datos del modulo {$this->modulo} para el registro por cedula: {$id}, Valores consultados: {$variableConsulta} -> Metodo show");
        } else {
            ActivityLogger::activity("Consulto datos del modulo {$this->modulo} para el registro con id: {$id},  Valores consultados: {$variableConsulta} -> Metodo show");
        }
        if ($variableConsulta->isEmpty()) {
            $variableConsulta = $this->configModelo::where('familia_id', $id)->get();
        } else {
            return ['data' => 'no existe', 'status' => '201'];
        }

        return ['data' => $variableConsulta, 'status' => '201'];
    }
    public function store(Request $request) {

        $variableConsulta = $this->configModelo;

        //Campos a guardar aquí--------------->
        $variableConsulta->ciudadano_id = $request->ciudadano_id;
        $variableConsulta->familia_id = $request->familia_id;
        $variableConsulta->parentesco = $request->parentesco;

        //   Datos antes de borrar------------------------------------->

        $ciudadano = DB::table('ciudadanos')->where('id', $request->familia_id)->first();
        $anteriorGrupo = DB::table('ciudadanos')->where('id', $request->familia_id)->get();
        $newCiudadano = new Familia;
        $newCiudadano->ciudadano_id = $request->ciudadano_id;
        $newCiudadano->parentesco = $request->parentesco;
        $newCiudadano->tipo_documento = $ciudadano->tipo_documento;
        $newCiudadano->numero_documento = $ciudadano->numero_documento;
        $newCiudadano->pep = $ciudadano->pep;
        $newCiudadano->nombres = $ciudadano->nombres;
        $newCiudadano->apellidos = $ciudadano->apellidos;
        $newCiudadano->fecha_expedicion = $ciudadano->fecha_expedicion;
        $newCiudadano->fecha_vencimiento = $ciudadano->fecha_vencimiento;
        $newCiudadano->fecha_nacimiento = $ciudadano->fecha_nacimiento;
        $newCiudadano->edad = $ciudadano->edad;
        $newCiudadano->genero = $ciudadano->genero;
        $newCiudadano->estado_civil = $ciudadano->estado_civil;
        $newCiudadano->telefono = $ciudadano->telefono;
        $newCiudadano->celular = $ciudadano->celular;
        $newCiudadano->correo_electronico = $ciudadano->correo_electronico;
        $newCiudadano->departamento = $ciudadano->departamento;
        $newCiudadano->ciudad = $ciudadano->ciudad;
        $newCiudadano->barrio = $ciudadano->barrio;
        $newCiudadano->comuna = $ciudadano->comuna;
        $newCiudadano->direccion = $ciudadano->direccion;
        $newCiudadano->actividad = $ciudadano->actividad;
        $newCiudadano->ciudad_origen = $ciudadano->ciudad_origen;
        $newCiudadano->pais_origen = $ciudadano->pais_origen;
        $newCiudadano->fecha_llegada = $ciudadano->fecha_llegada;
        $newCiudadano->intencion_ciudad = $ciudadano->intencion_ciudad;
        $newCiudadano->respuesta_intencion = $ciudadano->respuesta_intencion;
        $newCiudadano->fecha_llegada = $ciudadano->fecha_llegada;
        $newCiudadano->discapacidad = $ciudadano->discapacidad;
        $newCiudadano->salud = $ciudadano->salud;
        $newCiudadano->estudia_actualmente = $ciudadano->estudia_actualmente;
        $newCiudadano->nivel_escolaridad = $ciudadano->nivel_escolaridad;
        $newCiudadano->tipo_profesion = $ciudadano->tipo_profesion;
        $newCiudadano->comunidad_lgtbi = $ciudadano->comunidad_lgtbi;
        $newCiudadano->comunidad_etnica = $ciudadano->comunidad_etnica;
        $newCiudadano->trabajo = $ciudadano->trabajo;
        $newCiudadano->tipo_empleo = $ciudadano->tipo_empleo;
        $newCiudadano->observaciones = $ciudadano->observaciones;
        $newCiudadano->save();

        //   Datos antes de borrar------------------------------------->

        DB::table('familias')
            ->where('ciudadano_id', $request->familia_id)
            ->update(['ciudadano_id' => $request->ciudadano_id]);

        //Campos a guardar aquí--------------->

        //   Datos antes de borrar------------------------------------->

        DB::table('ayudas')
            ->where('ciudadano_id', $request->familia_id)
            ->update(['ciudadano_id' => $request->ciudadano_id]);

        //Campos a guardar aquí--------------->

        //   Borrando Ciudadano
        // DB::table('ciudadanos')->where('ciudadano_id', '=', $request->familia_id)->delete();
        $eliminar = Ciudadano::withTrashed()->find($request->familia_id);
        $eliminar->forceDelete();
        //   Borrando Ciudadano------------------------------------->
        $nuevoGrupo = DB::table('ciudadanos')->where('id', $request->ciudadano_id)->get();
        ActivityLogger::activity("Guardando datos del modulo {$this->modulo},se Transfiere a {$anteriorGrupo}, para el grupo de familia: {$nuevoGrupo} ,  Datos Guardados:{$nuevoGrupo}, -> Metodo Store.");
        $newTransferencia = new Transferencia;
        $newTransferencia->ciudadano_id = $request->ciudadano_id;
        $newTransferencia->familia_id = $newCiudadano->id;
        $newTransferencia->parentesco = $request->parentesco;
        $newTransferencia->save();
        return ['data' => $variableConsulta, 'status' => '202'];
    }
    public function update(Request $request, $id) {
        //
        $datosAnteriores = $this->configModelo::find($id);
        $variableConsulta = $this->configModelo::find($id);

        //Campos Actualizar aquí--------------->
        $variableConsulta->ciudadano_id = $request->ciudadano_id;
        $variableConsulta->familia_id = $request->familia_id;
        $variableConsulta->parentesco = $request->parentesco;
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
