<?php

namespace Modules\Reportes\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NucleoExport implements FromQuery, WithHeadings {
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query() {

        $familias = DB::table('familias as f')
            ->leftJoin('ciudadanos as c', 'c.id', '=', 'f.ciudadano_id')
            ->select(
                'f.tipo_documento',
                'f.numero_documento',
                'f.pep',
                'f.nombres',
                'f.apellidos',
                'f.fecha_expedicion',
                'f.fecha_vencimiento',
                'f.fecha_nacimiento',
                'f.edad',
                'f.genero',
                'f.estado_civil',
                'f.telefono',
                'f.celular',
                'f.correo_electronico',
                'c.departamento',
                'c.ciudad',
                'c.barrio',
                'c.comuna',
                'c.direccion',
                'c.actividad',
                'c.ciudad_origen',
                'c.pais_origen',
                'c.fecha_llegada',
                'c.intencion_ciudad',
                'c.respuesta_intencion',
                'f.discapacidad',
                'f.salud',
                'f.estudia_actualmente',
                'f.nivel_escolaridad',
                'f.tipo_profesion',
                'f.comunidad_lgtbi',
                'f.comunidad_etnica',
                'f.trabajo',
                'f.tipo_empleo',
                'f.observaciones',
                'f.estado',
                'f.usuario_creacion',
                'f.usuario_actualizacion',
                'f.deleted_at',
                'f.created_at',
                'f.updated_at'
            )->orderBy('c.id');

        $ciudadanos = DB::table('ciudadanos as ciud')
            ->select(
                'ciud.tipo_documento',
                'ciud.numero_documento',
                'ciud.pep',
                'ciud.nombres',
                'ciud.apellidos',
                'ciud.fecha_expedicion',
                'ciud.fecha_vencimiento',
                'ciud.fecha_nacimiento',
                'ciud.edad',
                'ciud.genero',
                'ciud.estado_civil',
                'ciud.telefono',
                'ciud.celular',
                'ciud.correo_electronico',
                'ciud.departamento',
                'ciud.ciudad',
                'ciud.barrio',
                'ciud.comuna',
                'ciud.direccion',
                'ciud.actividad',
                'ciud.ciudad_origen',
                'ciud.pais_origen',
                'ciud.fecha_llegada',
                'ciud.intencion_ciudad',
                'ciud.respuesta_intencion',
                'ciud.discapacidad',
                'ciud.salud',
                'ciud.estudia_actualmente',
                'ciud.nivel_escolaridad',
                'ciud.tipo_profesion',
                'ciud.comunidad_lgtbi',
                'ciud.comunidad_etnica',
                'ciud.trabajo',
                'ciud.tipo_empleo',
                'ciud.observaciones',
                'ciud.estado',
                'ciud.usuario_creacion',
                'ciud.usuario_actualizacion',
                'ciud.deleted_at',
                'ciud.created_at',
                'ciud.updated_at'
            )->unionAll($familias)->orderBy('created_at');

        return $ciudadanos;
    }
    public function headings(): array
    {
        return [
            'tipo_documento'
            , 'numero_documento'
            , 'pep'
            , 'nombres'
            , 'apellidos'
            , 'fecha_expedicion'
            , 'fecha_vencimiento'
            , 'fecha_nacimiento'
            , 'edad'
            , 'genero'
            , 'estado_civil'
            , 'telefono'
            , 'celular'
            , 'correo_electronico'
            , 'departamento'
            , 'ciudad'
            , 'barrio'
            , 'comuna'
            , 'direccion'
            , 'actividad'
            , 'ciudad_origen'
            , 'pais_origen'
            , 'fecha_llegada'
            , 'intencion_ciudad'
            , 'respuesta_intencion'
            , 'discapacidad'
            , 'salud'
            , 'estudia_actualmente'
            , 'nivel_escolaridad'
            , 'tipo_profesion'
            , 'comunidad_lgtbi'
            , 'comunidad_etnica'
            , 'trabajo'
            , 'tipo_empleo'
            , 'observaciones'
            , 'estado'
            , 'usuario_creacion'
            , 'usuario_actualizacion'
            , 'deleted_at'
            , 'created_at'
            , 'updated_at',

        ];
    }
}
