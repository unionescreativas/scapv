<?php

namespace Modules\Reportes\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AyudasExport implements FromQuery, WithHeadings {
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query() {
        return DB::table('ciudadanos')
            ->leftjoin('ayudas', 'ciudadanos.id', 'ayudas.ciudadano_id')
            ->whereNotNull('ayudas.id')
            ->select(
                'ciudadanos.tipo_documento',
                'ciudadanos.numero_documento',
                'ciudadanos.pep',
                'ciudadanos.nombres',
                'ciudadanos.apellidos',
                'ciudadanos.fecha_expedicion',
                'ciudadanos.fecha_vencimiento',
                'ciudadanos.fecha_nacimiento',
                'ciudadanos.edad',
                'ciudadanos.genero',
                'ciudadanos.estado_civil',
                'ciudadanos.telefono',
                'ciudadanos.celular',
                'ciudadanos.correo_electronico',
                'ciudadanos.departamento',
                'ciudadanos.ciudad',
                'ciudadanos.barrio',
                'ciudadanos.comuna',
                'ciudadanos.direccion',
                'ciudadanos.lat',
                'ciudadanos.let',
                'ciudadanos.actividad',
                'ciudadanos.ciudad_origen',
                'ciudadanos.pais_origen',
                'ciudadanos.fecha_llegada',
                'ciudadanos.intencion_ciudad',
                'ciudadanos.respuesta_intencion',
                'ciudadanos.discapacidad',
                'ciudadanos.salud',
                'ciudadanos.estudia_actualmente',
                'ciudadanos.nivel_escolaridad',
                'ciudadanos.tipo_profesion',
                'ciudadanos.comunidad_lgtbi',
                'ciudadanos.comunidad_etnica',
                'ciudadanos.trabajo',
                'ciudadanos.tipo_empleo',
                'ciudadanos.observaciones',
                'ayudas.cantidad_entregada',
                'ayudas.fecha_entrega',
            )
            ->orderBy("ciudadanos.id");
    }
    public function headings(): array
    {
        return [
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
            'PERTENECE ALGUNA COMUNIDAD ETNICA ?',
            'ACTUALMENTE SE ENCUENTRA LABORANDO',
            'TIPO DE EMPLEO',
            'OBSERVACIONES',
            'CANTIDAD ENTREGADA',
            'FECHA ENTREGA',
        ];
    }
}
