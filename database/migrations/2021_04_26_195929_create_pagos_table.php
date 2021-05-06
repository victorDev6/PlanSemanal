<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->text('comentarios')->nullable();
            $table->string('textColor');
            $table->date('fecha_enviado')->nullable();
            $table->string('modalidad')->nullable();

            $table->unsignedBigInteger('id_unidad')->nullable();
            $table->foreign('id_unidad')->references('id')->on('unidades');
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
        Schema::dropIfExists('pagos');
    }
}
