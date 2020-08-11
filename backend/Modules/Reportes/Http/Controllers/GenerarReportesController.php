<?php

namespace Modules\Reportes\Http\Controllers;


use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Reportes\Exports\AyudasExport;
use Illuminate\Contracts\Support\Renderable;
use Modules\Reportes\Exports\FamiliasExport;
use Modules\Reportes\Exports\CiudadanosExport;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use Modules\Reportes\Exports\AyudasPendientesExport;

class GenerarReportesController extends Controller
{

    public function exportarCiudadanos()
    {
        $nombre_archivo = (string) Uuid::generate(4);
        ActivityLogger::activity("Generando Reportes: Exportar Ciudadanos");
        return Excel::download(new CiudadanosExport, "ciudadanos-{$nombre_archivo}.xlsx");
    }

    public function exportarFamilias()
    {
        $nombre_archivo = (string) Uuid::generate(4);
        ActivityLogger::activity("Generando Reportes: Exportar Ciudadanos");
        return Excel::download(new FamiliasExport, "familias-{$nombre_archivo}.xlsx");
    }
    public function exportarAyudas()
    {
        $nombre_archivo = (string) Uuid::generate(4);
        ActivityLogger::activity("Generando Reportes: Exportar Ciudadanos");
        return Excel::download(new AyudasExport, "ayudas-{$nombre_archivo}.xlsx");
    }

    public function exportarAyudasPendientes()
    {
        $nombre_archivo = (string) Uuid::generate(4);
        ActivityLogger::activity("Generando Reportes: Exportar Ciudadanos");
        return Excel::download(new AyudasPendientesExport, "ayudaspendientes-{$nombre_archivo}.xlsx");
    }
}
