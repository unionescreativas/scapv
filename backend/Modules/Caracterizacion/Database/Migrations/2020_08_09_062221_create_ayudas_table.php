<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAyudasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ayudas', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            //aqui van los campos------------------>
            $table->uuid('lista_ayuda_id');
            $table->uuid('ciudadano_id');
            $table->integer('cantidad_entregada');
            $table->date('fecha_entrega');
            //aqui van los campos------------------>
            $table->boolean('estado')->default(1);
            $table->uuid('usuario_creacion')->nullable();
            $table->uuid('usuario_actualizacion')->nullable();
            $table->softDeletesTz();
            $table->timestamps();
            $table->foreign('ciudadano_id')
                ->references('id')->on('ciudadanos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ayudas');
    }
}
