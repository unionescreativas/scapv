<?php

namespace Modules\Estadisticas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DatosGeneralesController extends Controller {

    public function index(Request $request) {
        $ciudadanos = DB::table('ciudadanos')
            ->count('id');

        $familias = DB::table('familias')
            ->count('id');
        $total_nucleo = $ciudadanos + $familias;

        $total_ayudas = DB::table('ayudas')
            ->sum('cantidad_entregada');
        $pendiente_ayudas_cabeza = $ciudadanos - $total_ayudas;
        // $libros = DB::select('select * from books where 1');

        $datos = (object) [
            'ciudadanos' => $ciudadanos,
            'familias' => $familias,
            'total_nucleo' => (int) $total_nucleo,
            'total_ayudas' => (int) $total_ayudas,
            'pendiente_ayudas' => $total_nucleo - $total_ayudas,
            'pendiente_ayudas_cabeza' => $pendiente_ayudas_cabeza,
        ];
        return ['data' => $datos, 'status' => '202'];
    }
}
