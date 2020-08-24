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
use Illuminate\Support\Facades\Storage;

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
        return ['data' => $variableConsulta, 'status' => '201'];
    }
    public function store(Request $request)
    {

        // ------------------------>Datos Ruta
        $modulo = $request->modulo;
        $moduloId = $request->modulo_id;
        $ruta = "/documentos/{$modulo}/{$moduloId}/";
        // ------------------------>Datos Ruta
        $data = [];
        $variableConsulta = $this->configModelo;
        foreach ($request->file as $key => $value) {
            // // ------------------------>Datos Archivo
            $extensionArchivo = $request->file[$key]->getClientOriginalExtension();
            $nombreArchivo = (string) Uuid::generate(4) . "." . $extensionArchivo;
            $nombre_carga = $request->file[$key]->getClientOriginalName();
            $tamañoArchivo = $request->file[$key]->getSize();
            $aplicacionArchivo = $request->file[$key]->getMimeType();
            $ruta_carga = $request->file[$key]->getRealPath();
            $ruta_descarga = "{$ruta}{$nombreArchivo}";
            // ------------------------>Datos Archivo
            // Mover Archivo--------------->
            $path = $request->file[$key]->storeAs("public" . $ruta, $nombreArchivo);
            // $request->file[$key]->move(public_path($ruta), $nombreArchivo . "." . $extensionArchivo);
            //Mover Archivo--------------->
            $data[$key] = $variableConsulta::create([
                'modulo_id' => $moduloId,
                'modulo' => $modulo,
                'nombre_archivo' => $nombreArchivo,
                'nombre_carga' =>  $nombre_carga,
                'url' => $ruta,
                'url_descarga' => $ruta_descarga,
                'extension' => $extensionArchivo,
                'tamano' => $tamañoArchivo,
                'aplicacion' => $aplicacionArchivo,
                'ruta_carga' => $ruta_carga,
            ]);
            //Campos a guardar aquí--------------->
        }
        ActivityLogger::activity("Guardando datos del modulo {$this->modulo}, Datos Guardaros:{$variableConsulta}, -> Metodo Store.");
        return ['data' => $data, 'status' => '202'];
    }
    public function update(Request $request, $id)
    {
        //
        $datosAnteriores = $this->configModelo::find($id);
        $variableConsulta = $this->configModelo::find($id);

        //Campos Actualizar aquí--------------->
        $variableConsulta->nombre_carga = $request->nombre_carga;
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

    public function cors()
    {
        if (!$this->corsEnabled) {
            return;
        }
        header('Access-Control-Allow-Origin: *'); // Enable CORS
        header('Access-Control-Allow-Methods: POST, PUT, DELETE, OPTIONS'); // Allow CORS methods
        header('Access-Control-Allow-Headers: accept, content-type, x-test-header'); // Allow CORS methods

        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            exit;
        }
    }

    public function handle()
    {
        $this->cors();
        $response = $this->handleRequest();
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
