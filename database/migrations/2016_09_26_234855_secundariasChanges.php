<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SecundariasChanges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('secundarias', function(Blueprint $table){
           $table->dropPrimary('ID_Secundaria');
           $table->renameColumn('ID_Secundaria', 'clave_secundaria');
           $table->increments('ID_Secundaria');
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
