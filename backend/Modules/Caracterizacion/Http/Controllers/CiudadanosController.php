<?php

namespace Modules\Caracterizacion\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Caracterizacion\Entities\Ciudadano;
use Modules\Caracterizacion\Transformers\CiudadanoResource;
use Modules\Caracterizacion\Transformers\CiudadanoCollection;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;

class CiudadanosController extends Controller
{
    use ActivityLogger;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        ActivityLogger::activity("Consulto datos del modulo ciudadanos");
        $ciudadanos = Ciudadano::aplicarOrden(request('sort'))
            ->paginate(
                $perpage = request('page.size'),
                $columns = ['*'],
                $pageName = 'page',
                $page = request('page.number')
            )->appends(request()->query());
        return CiudadanoCollection::make($ciudadanos);
    }

    public function show(Ciudadano $ciudadano)
    {
        return CiudadanoResource::make($ciudadano);
    }

    public function create()
    {
        return view('caracterizacion::create');
    }


    public function store(Request $request)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('caracterizacion::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
