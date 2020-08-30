<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliasTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('familias', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            //aqui van los campos------------------>
            $table->uuid('ciudadano_id');
            $table->string('parentesco');
            $table->string('tipo_documento');
            $table->string('numero_documento');
            $table->string('pep')->nullable();
            $table->string('nombres');
            $table->string('apellidos');
            $table->date('fecha_expedicion')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('edad')->nullable();
            $table->string('genero')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('correo_electronico')->nullable();
            $table->string('departamento')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('bario')->nullable();
            $table->string('comuna')->nullable();
            $table->string('direccion')->nullable();
            $table->string('actividad')->nullable();
            $table->string('ciudad_origen')->nullable();
            $table->string('pais_origen')->nullable();
            $table->date('fecha_llegada')->nullable();
            $table->string('intencion_ciudad')->nullable();
            $table->string('respuesta_intencion')->nullable();
            $table->string('discapacidad')->nullable();
            $table->string('salud')->nullable();
            $table->string('estudia_actualmente')->nullable();
            $table->string('nivel_escolaridad')->nullable();
            $table->string('tipo_profesion')->nullable();
            $table->string('comunidad_lgtbi')->nullable();
            $table->string('comunidad_etnica')->nullable();
            $table->string('trabajo')->nullable();
            $table->string('tipo_empleo')->nullable();
            $table->text('observaciones')->nullable();

            //aqui van los campos------------------>
            $table->boolean('estado')->default(1);
            $table->uuid('usuario_creacion')->nullable();
            $table->uuid('usuario_actualizacion')->nullable();
            $table->softDeletesTz();
            $table->timestamps();
            $table->foreign('ciudadano_id')
                ->references('id')->on('ciudadanos');
            $table->unique('numero_documento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('familias');
    }
}
