<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListasTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('listas', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            //aqui van los campos------------------>
            $table->string('nombre_lista');
            $table->string('codigo_campo');
            $table->string('valor_campo_1');
            $table->string('valor_campo_2')->nullable();
            $table->string('valor_campo_3')->nullable();
            $table->string('valor_campo_4')->nullable();

            //aqui van los campos------------------>
            $table->boolean('estado')->default(1);
            $table->uuid('usuario_creacion')->nullable();
            $table->uuid('usuario_actualizacion')->nullable();
            $table->softDeletesTz();
            $table->timestamps();
            $table->unique('codigo_campo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('listas');
    }
}
