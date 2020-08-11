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
        $ciudadanos = DB::table('ciudadanos')
            ->count('id');

        $familias = DB::table('familias')
            ->count('id');
        $total_nucleo = $ciudadanos + $familias;

        $total_ayudas = DB::table('ayudas')
            ->sum('cantidad_entregada');
        // $libros = DB::select('select * from books where 1');

        $datos = (object) [
            'ciudadanos' => $ciudadanos,
            'familias' => $familias,
            'total_nucleo' => (int) $total_nucleo,
            'total_ayudas' => (int)$total_ayudas,
            'pendiente_ayudas' => $total_nucleo - $total_ayudas
        ];
        return ['data' =>  $datos, 'status' => '202'];
    }
}
