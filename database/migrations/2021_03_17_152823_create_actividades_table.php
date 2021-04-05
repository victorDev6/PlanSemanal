<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('asunto');
            $table->unsignedBigInteger('area_responsable');
            $table->text('actividad');
            $table->string('status');
            $table->text('observaciones')->nullable();
            $table->integer('semana');
            $table->date('fecha_enviado')->nullable();
            $table->unsignedBigInteger('id_organo');
            $table->unsignedBigInteger('id_departamento');

            $table->string('status_vtoBueno')->nullable();
            $table->date('fecha_vToBueno')->nullable();

            $table->string('status_validacion')->nullable();
            $table->date('fecha_validacion')->nullable();

            $table->text('obs_direccion')->nullable();
            $table->text('ind_direccion')->nullable();
            $table->date('fecha_direccion')->nullable();

            $table->foreign('id_organo')->references('id')->on('organos');
            $table->foreign('area_responsable')->references('id')->on('organos');
            $table->foreign('id_departamento')->references('id')->on('organos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividades');
    }
}
