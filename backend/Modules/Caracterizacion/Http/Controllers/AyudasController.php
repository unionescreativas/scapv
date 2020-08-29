<?php

namespace Modules\Caracterizacion\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use Modules\Caracterizacion\Entities\Ayuda;
use Modules\Caracterizacion\Http\Requests\AyudaRequest;

class AyudasController extends Controller {

    protected $configModelo;
    protected $modulo;

    public function __construct() {
        // Variables Globales---------------------------->
        $this->configModelo = new Ayuda;
        $this->modulo = "Ayudas";
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
                "lista", "ciudadano",
            ]
        )->where('ayudas.estado', '1');
        $data = $variableConsulta->paginate($length);
        return new DataTableCollectionResource($data);
    }
    public function editarRegistro($id) {
        $variableConsulta = $this->configModelo::where('id', $id)->get();
        if ($variableConsulta->isEmpty()) {
            $variableConsulta = $this->configModelo::where('id', $id)->get();
            ActivityLogger::activity("Consulto datos del modulo {$this->modulo} para el registro por cedula: {$id}, Valores consultados: {$variableConsulta} -> Metodo show");
        } else {
            ActivityLogger::activity("Consulto datos del modulo {$this->modulo} para el registro con id: {$id},  Valores consultados: {$variableConsulta} -> Metodo show");
        }
        if ($variableConsulta->isEmpty()) {
            return ['data' => 'no existe', 'status' => '201'];
        }
        return ['data' => $variableConsulta, 'status' => '201'];
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
                "lista", "ciudadano",
            ]
        )->where('ciudadanos.estado', '1')
            ->where('ciudadanos.id', $id);

        $length = 20;
        if ($variableConsulta) {
            $variableConsulta = $this->configModelo::eloquentQuery(
                $sortBy,
                $orderBy,
                $searchValue,
                [
                    "lista", "ciudadano",
                ]
            )->where('ciudadanos.estado', '1')->where('ciudadano_id', $id);
            $data = $variableConsulta->paginate($length);
            return new DataTableCollectionResource($data);
            ActivityLogger::activity("Consulto datos del modulo {$this->modulo} para el registro por cedula: {$id}, Valores consultados: {$variableConsulta} -> Metodo show");
        } else {
            ActivityLogger::activity("Consulto datos del modulo {$this->modulo} para el registro con id: {$id},  Valores consultados: {$variableConsulta} -> Metodo show");
        }
        if ($variableConsulta->isEmpty()) {
            return ['data' => 'no existe', 'status' => '201'];
        }

        return ['data' => $variableConsulta, 'status' => '201'];
    }
    public function store(AyudaRequest $request) {
        $cantidadDisponibles = 0;
        $cantidadEntregadasAnteriormente = 0;
        $cantidadEntregada = 0;
        $disponible = 0;
        // ----------------------------------->Validadon Ayudas Disponibles;
        $disponibilidad = DB::table('listas')->where('id', $request->lista_id)
            ->first();
        $cantidadDisponibles = (int) $disponibilidad->valor_campo_2;
        // ----------------------------------->Validadon Ayudas Disponibles;

        // ----------------------------------->Validadon Ayudas Entregadas Anteriormente;
        $ayudasEntregadas = DB::table('ayudas')
            ->where('lista_id', $request->lista_id)
            ->where('ciudadano_id', $request->ciudadano_id)->sum('cantidad_entregada');
        if (!is_null($ayudasEntregadas)) {
            $cantidadEntregadasAnteriormente = (int) $ayudasEntregadas;
        }
        // ----------------------------------->Validadon Ayudas Entregadas Anteriormente;
        $cantidadEntregada = $request->cantidad_entregada;
        // ---------->Calculando Unidades Entregadas
        $disponible = $cantidadDisponibles - ($cantidadEntregadasAnteriormente + $cantidadEntregada);
        // ---------->Calculando Unidades Entregadas

        if ($disponible < 0) {
            return ['data' => 'Disponibles 0', 'validacion' => false, 'status' => '202'];

        } else {
            $variableConsulta = $this->configModelo;
            //Campos a guardar aquí--------------->
            $variableConsulta->lista_id = $request->lista_id;
            $variableConsulta->ciudadano_id = $request->ciudadano_id;
            $variableConsulta->cantidad_entregada = $request->cantidad_entregada;
            $variableConsulta->fecha_entrega = $request->fecha_entrega;
            $variableConsulta->usuario_creacion = Auth::id();
            //Campos a guardar aquí--------------->
            $variableConsulta->save();
            ActivityLogger::activity("Guardando datos del modulo {$this->modulo}, Datos Guardaros:{$variableConsulta}, -> Metodo Store.");
            return ['data' => 'Disponibles : ' . $variableConsulta, 'validacion' => true, 'status' => '202'];
        }
    }

    public function consultandoUnidades(Request $request) {
        $cantidadDisponibles = 0;
        $cantidadEntregadasAnteriormente = 0;
        $cantidadEntregada = 0;
        $disponible = 0;
        // ----------------------------------->Validadon Ayudas Disponibles;
        $disponibilidad = DB::table('listas')->where('id', $request->lista_id)
            ->first();
        $cantidadDisponibles = (int) $disponibilidad->valor_campo_2;
        // ----------------------------------->Validadon Ayudas Disponibles;

        // ----------------------------------->Validadon Ayudas Entregadas Anteriormente;
        $ayudasEntregadas = DB::table('ayudas')
            ->where('lista_id', $request->lista_id)
            ->where('ciudadano_id', $request->ciudadano_id)->sum('cantidad_entregada');
        if (!is_null($ayudasEntregadas)) {
            $cantidadEntregadasAnteriormente = (int) $ayudasEntregadas;
        }
        // ----------------------------------->Validadon Ayudas Entregadas Anteriormente;

        // ---------->Calculando Unidades Entregadas
        $cantidadEntregada = (int) $request->cantidad_entregada;
        $disponible = $cantidadDisponibles - ($cantidadEntregadasAnteriormente + $cantidadEntregada);
        // ---------->Calculando Unidades Entregadas

        $datos = DB::table('ayudas')
            ->where('lista_id', $request->lista_id)
            ->where('ciudadano_id', $request->ciudadano_id)->first();

        if ($disponible < 0) {
            return ['data' => $datos, 'unidades' => 'Disponibles :' . $disponible, 'validacion' => false, 'status' => '203'];
        }
        $disponible = $cantidadDisponibles - ($cantidadEntregadasAnteriormente);
        return ['data' => $datos, 'unidades' => 'Disponibles :' . $disponible, 'validacion' => true, 'status' => '202'];
    }
    public function update(AyudaRequest $request, $id) {
        //

        $cantidadDisponibles = 0;
        $cantidadEntregadasAnteriormente = 0;
        $cantidadEntregada = 0;
        $cantidadesModificando = 0;
        $disponible = 0;

        // ----------------------------------->Unidades a Modificar;
        $cantidadesModificando = DB::table('ayudas')
            ->where('id', $id)
            ->sum('cantidad_entregada');
        if (!is_null($cantidadesModificando)) {
            $cantidadesModificando = (int) $cantidadesModificando;
        }
        // ----------------------------------->Unidades a Modificar;

        // ----------------------------------->Validadon Ayudas Disponibles;
        $disponibilidad = DB::table('listas')->where('id', $request->lista_id)
            ->first();
        $cantidadDisponibles = (int) $disponibilidad->valor_campo_2;
        // ----------------------------------->Validadon Ayudas Disponibles;

        // ----------------------------------->Validadon Ayudas Entregadas Anteriormente;
        $ayudasEntregadas = DB::table('ayudas')
            ->where('lista_id', $request->lista_id)
            ->where('ciudadano_id', $request->ciudadano_id)->sum('cantidad_entregada');
        if (!is_null($ayudasEntregadas)) {
            $cantidadEntregadasAnteriormente = (int) $ayudasEntregadas;
        }
        $cantidadEntregadasAnteriormente = $cantidadEntregadasAnteriormente - $cantidadesModificando;
        // ----------------------------------->Validadon Ayudas Entregadas Anteriormente;
        $cantidadEntregada = $request->cantidad_entregada;
        // ---------->Calculando Unidades Entregadas
        $disponible = $cantidadDisponibles - ($cantidadEntregadasAnteriormente + $cantidadEntregada);

        if ($disponible < 0) {
            return ['data' => 'sin stock', 'status' => '202'];
        } else {
            $datosAnteriores = $this->configModelo::find($id);
            $variableConsulta = $this->configModelo::find($id);
            //Campos a guardar aquí--------------->
            $variableConsulta->lista_id = $request->lista_id;
            $variableConsulta->ciudadano_id = $request->ciudadano_id;
            $variableConsulta->cantidad_entregada = $request->cantidad_entregada;
            $variableConsulta->fecha_entrega = $request->fecha_entrega;
            $variableConsulta->usuario_actualizacion = Auth::id();

            //Campos a guardar aquí--------------->
            $variableConsulta->save();
            ActivityLogger::activity("Actualizando datos del modulo {$this->modulo},  Datos Anteriores:{$datosAnteriores}  Datos Nuevos:{$variableConsulta}, para el registro id {$id} ->Metodo Update.");
            return ['data' => $variableConsulta, 'status' => '203'];
        }
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
