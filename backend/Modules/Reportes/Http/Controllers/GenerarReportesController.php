<?php

namespace Modules\Reportes\Http\Controllers;

use Illuminate\Routing\Controller;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Reportes\Exports\AyudasExport;
use Modules\Reportes\Exports\AyudasPendientesExport;
use Modules\Reportes\Exports\CiudadanosExport;
use Modules\Reportes\Exports\FamiliasExport;
use Modules\Reportes\Exports\NucleoExport;
use Webpatser\Uuid\Uuid;

class GenerarReportesController extends Controller {

    public function exportarCiudadanos() {
        $nombre_archivo = (string) Uuid::generate(4);
        ActivityLogger::activity("Generando Reportes: Exportar Ciudadanos");
        return Excel::download(new CiudadanosExport, "ciudadanos-{$nombre_archivo}.xlsx");
    }

    public function exportarFamilias() {
        $nombre_archivo = (string) Uuid::generate(4);
        ActivityLogger::activity("Generando Reportes: Exportar Ciudadanos");
        return Excel::download(new FamiliasExport, "familias-{$nombre_archivo}.xlsx");
    }
    public function exportarAyudas() {
        $nombre_archivo = (string) Uuid::generate(4);
        ActivityLogger::activity("Generando Reportes: Exportar Ciudadanos");
        return Excel::download(new AyudasExport, "ayudas-{$nombre_archivo}.xlsx");
    }

    public function exportarAyudasPendientes() {
        $nombre_archivo = (string) Uuid::generate(4);
        ActivityLogger::activity("Generando Reportes: Exportar Ciudadanos");
        return Excel::download(new AyudasPendientesExport, "ayudaspendientes-{$nombre_archivo}.xlsx");
    }
    public function exportarNucleo() {
        $nombre_archivo = (string) Uuid::generate(4);
        ActivityLogger::activity("Generando Reportes: Exportar Ciudadanos");
        return Excel::download(new NucleoExport, "nucleo-{$nombre_archivo}.xlsx");
    }
}
