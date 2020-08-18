<?php

namespace Modules\Caracterizacion\Http\Controllers;


use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Caracterizacion\Entities\Documento;
use Modules\Caracterizacion\Http\Requests\DocumentoRequest;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class DocumentosController extends Controller
{

    protected $configModelo;
    protected $modulo;

    public function __construct()
    {
        // Variables Globales---------------------------->
        $this->configModelo = new Documento;
        $this->modulo = "Documentos";
        // Variables Globales---------------------------->

    }

    public function index(Request $request)
    {
        $modulo_id = $request->input('modulo_id');
        $modulo = $request->input('modulo');
        $variableConsulta = $this->configModelo::where('modulo', $modulo)
            ->where('modulo_id', $modulo_id)->where('estado', '1')->get();
        ActivityLogger::activity("Consulto datos del modulo {$this->modulo},Parametros: Cantidad de registros: -> Metodo Index");
        return ['data' => $variableConsulta, 'status' => '201'];
    }
    public function show($id)
    {
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
    public function store(DocumentoRequest $request)
    {

        // ------------------------>Datos Archivo
        $nombreArchivo = (string) Uuid::generate(4);
        $nombreCarga = $request->file->getClientOriginalName();
        $extensionArchivo = $request->file->getClientOriginalExtension();
        $tamañoArchivo = $request->file->getSize() / 1000;
        $aplicacionArchivo = $request->file->getMimeType();
        $ruta_carga = $request->file->getRealPath();
        // ------------------------>Datos Archivo

        // ------------------------>Datos Ruta
        $modulo = $request->modulo;
        $moduloId = $request->modulo_id;
        $ruta = "/{$modulo}/{$moduloId}/";
        $request->file->move(public_path($ruta), $nombreArchivo . "." . $extensionArchivo);
        // ------------------------>Datos Ruta

        $variableConsulta = $this->configModelo;

        //Campos a guardar aquí--------------->
        $variableConsulta->modulo_id = $moduloId;
        $variableConsulta->modulo = $modulo;
        $variableConsulta->nombre_archivo = $nombreArchivo;
        $variableConsulta->nombre_carga = $nombreCarga;
        $variableConsulta->url = $ruta;
        $variableConsulta->extension = $extensionArchivo;
        $variableConsulta->tamano = $tamañoArchivo;
        $variableConsulta->aplicacion = $aplicacionArchivo;
        $variableConsulta->ruta_carga = $ruta_carga;



        //Campos a guardar aquí--------------->

        $variableConsulta->save();
        ActivityLogger::activity("Guardando datos del modulo {$this->modulo}, Datos Guardaros:{$variableConsulta}, -> Metodo Store.");
        return ['data' => $variableConsulta, 'status' => '202'];
        // $fileName = time() . '.' . $request->file->getClientOriginalExtension();
        // $request->file->move(public_path('files'), $fileName);

        // return response()->json(['file' => $fileName]);




    }
    public function update(DocumentoRequest $request, $id)
    {
        //
        $datosAnteriores = $this->configModelo::find($id);
        $variableConsulta = $this->configModelo::find($id);

        //Campos Actualizar aquí--------------->
        $variableConsulta->tipo_documento = $request->tipo_documento;
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
