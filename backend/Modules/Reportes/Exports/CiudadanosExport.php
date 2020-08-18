<?php

namespace Modules\Reportes\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CiudadanosExport implements FromQuery, WithHeadings {
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query() {
        return DB::table('ciudadanos')->where('deleted_at', null)
            ->orderBy("ciudadanos.created_at");
    }
    public function headings(): array
    {
        return [
            '#',
            'TIPO DE DOCUMENTO',
            'NUMERO DE DOCUMENTO',
            '# PERMISO ESPECIAL DE PERMANENCIA',
            'NOMBRES',
            'APELLIDOS',
            'FECHA DE EXPEDICION DEL DOCUMENTO',
            'FECHA DE VENCIMIENTO DEL DOCUMENTO',
            'FECHA DE NACIMIENTO',
            'EDAD',
            'GENERO',
            'ESTADO CIVIL',
            'TELEFONO',
            'CELULAR',
            'CORREO ELECTRONICO',
            'DEPARTAMENTO DE RESIDENCIA',
            'CIUDAD DE RESIDENCIA',
            'BARRIO DE RESIDENCIA',
            'COMUNA DE RESIDENCIA',
            'direccion DE RESIDENCIA',
            'LATITUD',
            'LONGITUD',
            'ACTIVIDAD',
            'CIUDAD DE ORIGEN',
            'PAIS DE ORIGEN',
            'FECHA DE LLEGADA AL PAIS',
            'FECHA DE LLEGADA AL PAIS',
            'FECHA DE LLEGADA AL PAIS',
            'TIENE ALGUNA DISCAPACIDAD',
            'TIENE SISTEMA DE SALUD',
            'SE ENCUENTRA ESTUDIANDO ACTUALMENTE',
            'NIVEL DE ESCOLARIDAD',
            'PROFESIONAL EN ?',
            'POBLACIÓN LGTBI',
            'PERTENECE ALGUNA COMUNA ETNICA ?',
            'ACTUALMENTE SE ENCUENTRA LABORANDO',
            'TIPO DE EMPLEO',
            'OBSERVACIONES',
            'ESTADO',
            'USUARIO CREACION',
            'USUARIO MODIFICACION',
            'FECHA ELIMINACIÓN',
            'FECHA CREACION',
            'FECHA ACTUALIZACION',
        ];
    }
}
