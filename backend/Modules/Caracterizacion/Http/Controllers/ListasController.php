<?php

namespace Modules\Caracterizacion\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Caracterizacion\Entities\Lista;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class ListasController extends Controller
{

    protected $configModelo;
    protected $modulo;

    public function __construct()
    {
        // Variables Globales---------------------------->
        $this->configModelo = new Lista;
        $this->modulo = "Listas";
        // Variables Globales---------------------------->

    }

    public function index(Request $request)
    {
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
        ActivityLogger::activity("Consulto datos del modulo {$this->modulo},Parametros: Cantidad de registros: {$length}, Tipo de Ordenamiento:{$sortBy}, Campo para ordenar:{$orderBy}, Valor a Buscar {$searchValue}-> Metodo Index");
        $variableConsulta = $this->configModelo::eloquentQuery($sortBy, $orderBy, $searchValue)->where('estado', '1');
        $data = $variableConsulta->paginate($length);
        return new DataTableCollectionResource($data);
    }
    public function show($id)
    {
        $variableConsulta = $this->configModelo::where('id', $id)->where('estado', '1')->get();
        if ($variableConsulta->isEmpty()) {
            $variableConsulta = $this->configModelo::where('codigo_lista', $id)->get();
            ActivityLogger::activity("Consulto datos del modulo {$this->modulo} para el registro por cedula: {$id}, Valores consultados: {$variableConsulta} -> Metodo show");
        } else {
            ActivityLogger::activity("Consulto datos del modulo {$this->modulo} para el registro con id: {$id},  Valores consultados: {$variableConsulta} -> Metodo show");
        }
        if ($variableConsulta->isEmpty()) {
            return ['data' => 'no existe', 'status' => '201'];
        }

        return ['data' => $variableConsulta, 'status' => '201'];
    }

    public function store(Request $request)
    {

        $variableConsulta = $this->configModelo;

        //Campos a guardar aquí--------------->
        $variableConsulta->codigo_lista = $request->codigo_lista;
        $variableConsulta->codigo_campo = $request->codigo_campo;
        $variableConsulta->valor_campo_1 = $request->valor_campo_1;
        $variableConsulta->valor_campo_2 = $request->valor_campo_2;
        $variableConsulta->valor_campo_3 = $request->valor_campo_3;
        $variableConsulta->valor_campo_4 = $request->valor_campo_4;

        //Campos a guardar aquí--------------->

        $variableConsulta->save();
        ActivityLogger::activity("Guardando datos del modulo {$this->modulo}, Datos Guardaros:{$variableConsulta}, -> Metodo Store.");
        return ['data' => $variableConsulta, 'status' => '202'];
    }
    public function update(Request $request, $id)
    {
        //
        $datosAnteriores = $this->configModelo::find($id);
        $variableConsulta = $this->configModelo::find($id);

        //Campos Actualizar aquí--------------->
        $variableConsulta->codigo_lista = $request->codigo_lista;
        $variableConsulta->codigo_campo = $request->codigo_campo;
        $variableConsulta->valor_campo_1 = $request->valor_campo_1;
        $variableConsulta->valor_campo_2 = $request->valor_campo_2;
        $variableConsulta->valor_campo_3 = $request->valor_campo_3;
        $variableConsulta->valor_campo_4 = $request->valor_campo_4;
        //Campos Actualizar aquí--------------->

        $variableConsulta->save();
        ActivityLogger::activity("Actualizando datos del modulo {$this->modulo},  Datos Anteriores:{$datosAnteriores}  Datos Nuevos:{$variableConsulta}, para el registro id {$id} ->Metodo Update.");
        return ['data' => $variableConsulta, 'status' => '203'];
    }
    public function destroy($id)
    {
        $variableConsulta = $this->configModelo::find($id);
        $datosElimnados = $variableConsulta;
        $variableConsulta = $this->configModelo::destroy($id);
        ActivityLogger::activity("Eliminado Registo Modulo {$this->modulo},Datos eliminados:{$datosElimnados},  para el registro {$id} -> Metodo destroy");
        return ['data' => $variableConsulta, 'status' => '204'];
    }

    public function activar($id)
    {
        $variableConsulta = $this->configModelo::find($id);
        $datosActivar = $variableConsulta;
        ActivityLogger::activity("Activando Registo Modulo {$this->modulo},Datos Activar: {$datosActivar}, para el registro {$id} -> Metodo Activar.");
        $variableConsulta->estado = 1;
        $variableConsulta->save();
        return ['data' => $variableConsulta, 'status' => '205'];
    }

    public function inactivar($id)
    {
        $variableConsulta = $this->configModelo::find($id);
        $datosActivar = $variableConsulta;
        ActivityLogger::activity("Inactivando Registo Modulo {$this->modulo},Datos Inactivar: {$datosActivar}, para el registro {$id} -> Metodo Inactivar.");
        $variableConsulta->estado = 0;
        $variableConsulta->save();
        return ['data' => $variableConsulta, 'status' => '206'];
    }
    public function restore($id)
    {
        $variableConsulta = $this->configModelo::withTrashed()->find($id);
        $datosRestaurar = $variableConsulta;
        ActivityLogger::activity("Restaurando Registo Modulo {$this->modulo},Datos a Restaurar: {$datosRestaurar}, para el registro {$id} -> Metodo Restaurar.");
        $variableConsulta->restore();
        return ['data' => $variableConsulta, 'status' => '207'];
    }
}
