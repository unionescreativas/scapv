<?php

namespace Modules\Caracterizacion\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Ordenar
{
    public function scopeAplicarOrden(Builder $query, $sort)
    {
        if (is_null($sort)) {
            return;
        }
        $ordenarCampos = Str::of($sort)->explode(',');
        foreach ($ordenarCampos as $ordenarCampo) {
            $direcion = 'asc';
            if (Str::of($ordenarCampo)->startsWith('-')) {
                $direcion = 'desc';
                $ordenarCampo = Str::of($ordenarCampo)->substr(1);
            }
            $query->orderBy($ordenarCampo, $direcion)->get();
        }
    }
}
