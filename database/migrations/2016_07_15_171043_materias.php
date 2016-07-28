<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Materias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias', function(Blueprint $table){
                $table->increments('materia_id');
                $table->string('clave_materia', 20);
                $table->string('nombre_materia', 50);
                $table->integer('maestro_id');
                $table->boolean('activo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('materias');
    }
}
