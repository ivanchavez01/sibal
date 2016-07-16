<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Expedientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedientes', function(Blueprint $table){
                $table->integer('exprediente_id')->primary();
                $table->integer('curso_id');
                $table->integer('alumno_id');
                $table->decimal('calificacion', 5, 2);                
                $table->boolean('revalidada');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('expedientes');
    }
}
