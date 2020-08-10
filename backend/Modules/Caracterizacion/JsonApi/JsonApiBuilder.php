<?php

namespace Modules\Caracterizacion\JsonApi;

use Illuminate\Support\Str;

class JsonApiBuilder
{
    public function aplicarOrden()
    {
        return function () {
            if (is_null($sort = request('sort'))) {
                return $this;
            }
            $ordenarCampos = Str::of($sort)->explode(',');
            foreach ($ordenarCampos as $ordenarCampo) {
                $direcion = 'asc';
                if (Str::of($ordenarCampo)->startsWith('-')) {
                    $direcion = 'desc';
                    $ordenarCampo = Str::of($ordenarCampo)->substr(1);
                }
                $this->orderBy($ordenarCampo, $direcion)->get();
            }
            return $this;
        };
    }
    public function paginacion()
    {
        return function () {
            return $this->paginate(
                $perpage = request('page.size'),
                $columns = ['*'],
                $pageName = 'page',
                $page = request('page.number')
            )->appends(request()->query());
        };
    }
}
