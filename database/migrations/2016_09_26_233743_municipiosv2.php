<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Municipiosv2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alumnos', function(Blueprint $table){
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::table('estados', function(Blueprint $table){
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::table('expediente', function(Blueprint $table){
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::table('alergias', function(Blueprint $table){
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::table('secundarias', function(Blueprint $table){
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::table('discapacidades', function(Blueprint $table){
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
