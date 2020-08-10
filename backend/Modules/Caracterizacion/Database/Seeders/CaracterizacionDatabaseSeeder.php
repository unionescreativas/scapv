<?php

namespace Modules\Caracterizacion\Database\Seeders;

use Webpatser\Uuid\Uuid;
use Illuminate\Support\Str;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class CaracterizacionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = Uuid::generate(4);
        DB::table('ciudadanos')->insert([
            'id' => $id,
            'tipo_documento' => Str::random(10),
            'numero_documento' => Str::random(10),
            'pep' => Str::random(10),
            'nombres' => Str::random(10),
            'apellidos' => Str::random(10),
            'fecha_expedicion' => Carbon::parse('2000-01-01'),
            'fecha_vencimiento' => Carbon::parse('2000-01-01'),
            'fecha_nacimiento' => Carbon::parse('2000-01-01'),
            'edad' => 23,
            'genero' => Str::random(10),
            'estado_civil' => Str::random(10),
            'telefono' => Str::random(10),
            'celular' => Str::random(10),
            'correo_electronico' => Str::random(10),
            'departamento' => Str::random(10),
            'ciudad' => Str::random(10),
            'barrrio' => Str::random(10),
            'comuna' => Str::random(10),
            'dirrecion' => Str::random(10),
            'actividad' => Str::random(10),
            'ciudad_origen' => Str::random(10),
            'pais_origen' => Str::random(10),
            'fecha_llegada' => Carbon::parse('2000-01-01'),
            'intencion_ciudad' => Str::random(10),
            'respuesta_intencion' => Str::random(10),
            'discapacidad' => Str::random(10),
            'salud' => Str::random(10),
            'estudia_actualmente' => Str::random(10),
            'nivel_escolaridad' => Str::random(10),
            'tipo_profesion' => Str::random(10),
            'comunidad_lgtbi' => Str::random(10),
            'comunidad_etnica' => Str::random(10),
            'trabajo' => Str::random(10),
            'tipo_empleo' => Str::random(10),
            'observaciones' => Str::random(10)
        ]);
    }
}
