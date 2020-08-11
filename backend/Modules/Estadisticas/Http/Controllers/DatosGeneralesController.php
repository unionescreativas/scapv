<?php

namespace Modules\Estadisticas\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class DatosGeneralesController extends Controller
{

    public function index(Request $request)
    {
        $ayudasEntregadas = DB::table('ayudas')
            ->where('lista_id', $request->lista_id)
            ->where('ciudadano_id', $request->ciudadano_id)->sum('cantidad_entregada');
    }
}
