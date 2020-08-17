<?php

namespace Modules\Reportes\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class FamiliasExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        // $libros = DB::select('select * from books where 1');
        return DB::table('familias as f')
            ->leftJoin('ciudadanos as c', 'c.id', '=', 'f.ciudadano_id')
            ->select(
                'c.tipo_documento',
                'c.numero_documento',
                'c.pep',
                'c.nombres',
                'c.apellidos',
                'c.fecha_expedicion',
                'c.fecha_vencimiento',
                'c.fecha_nacimiento',
                'c.edad',
                'c.genero',
                'c.estado_civil',
                'c.telefono',
                'c.celular',
                'c.correo_electronico',
                'c.departamento',
                'c.ciudad',
                'c.barrio',
                'c.comuna',
                'c.direcion',
                'c.actividad',
                'c.ciudad_origen',
                'c.pais_origen',
                'c.fecha_llegada',
                'c.intencion_ciudad',
                'c.respuesta_intencion',
                'c.discapacidad',
                'c.salud',
                'c.estudia_actualmente',
                'c.nivel_escolaridad',
                'c.trabajo',
                'f.parentesco as Familia_parentesco',
                'f.tipo_documento as Familia_tipo_documento',
                'f.numero_documento as Familia_numero_documento',
                'f.pep as Familia_pep',
                'f.nombres as Familia_nombres',
                'f.apellidos as Familia_apellidos',
                'f.fecha_expedicion as Familia_fecha_expedicion',
                'f.fecha_vencimiento as Familia_fecha_vencimiento',
                'f.fecha_nacimiento as Familia_fecha_nacimiento',
                'f.edad as Familia_edad',
                'f.genero as Familia_genero',
                'f.estado_civil as Familia_estado_civil',
                'f.telefono as Familia_telefono',
                'f.celular as Familia_celular',
                'f.correo_electronico as Familia_correo_electronico',
                'f.departamento as Familia_departamento',
                'f.ciudad as Familia_ciudad',
                'f.barrio as Familia_barrio',
                'f.comuna as Familia_comuna',
                'f.direcion as Familia_direcion',
                'f.actividad as Familia_actividad',
                'f.ciudad_origen as Familia_ciudad_origen',
                'f.pais_origen as Familia_pais_origen',
                'f.fecha_llegada as Familia_fecha_llegada',
                'f.discapacidad as Familia_discapacidad',
                'f.salud as Familia_salud',
                'f.estudia_actualmente as Familia_estudia_actualmente',
                'f.nivel_escolaridad as Familia_nivel_escolaridad',
                'f.trabajo as Familia_trabajo',
            )
            ->orderBy('f.ciudadano_id', 'ASC');
    }
    public function headings(): array
    {
        return [
            'TIPO_DOCUMENTO',
            'NUMERO_DOCUMENTO',
            'PEP',
            'NOMBRES',
            'APELLIDOS',
            'FECHA_EXPEDICION',
            'FECHA_VENCIMIENTO',
            'FECHA_NACIMIENTO',
            'EDAD',
            'GENERO',
            'ESTADO_CIVIL',
            'TELEFONO',
            'CELULAR',
            'CORREO_ELECTRONICO',
            'DEPARTAMENTO',
            'CIUDAD',
            'barrio',
            'COMUNA',
            'direcion',
            'ACTIVIDAD',
            'CIUDAD_ORIGEN',
            'PAIS_ORIGEN',
            'FECHA_LLEGADA',
            'INTENCION_CIUDAD',
            'RESPUESTA_INTENCION',
            'DISCAPACIDAD',
            'SALUD',
            'ESTUDIA_ACTUALMENTE',
            'NIVEL_ESCOLARIDAD',
            'TRABAJO',
            'PARENTESCO',
            'TIPO_DOCUMENTO',
            'NUMERO_DOCUMENTO',
            'PEP',
            'NOMBRES',
            'APELLIDOS',
            'FECHA_EXPEDICION',
            'FECHA_VENCIMIENTO',
            'FECHA_NACIMIENTO',
            'EDAD',
            'GENERO',
            'ESTADO_CIVIL',
            'TELEFONO',
            'CELULAR',
            'CORREO_ELECTRONICO',
            'DEPARTAMENTO',
            'CIUDAD',
            'barrio',
            'COMUNA',
            'direcion',
            'ACTIVIDAD',
            'CIUDAD_ORIGEN',
            'PAIS_ORIGEN',
            'FECHA_LLEGADA',
            'DISCAPACIDAD',
            'SALUD',
            'ESTUDIA_ACTUALMENTE',
            'NIVEL_ESCOLARIDAD',
            'TRABAJO',
        ];
    }
}
