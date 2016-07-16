<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Alumnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function(Blueprint $table){
                $table->increments('alumno_id');
                $table->char('usuario_sibal', 12);
                $table->string('nombre', 50);
                $table->string('apellido_paterno', 20);                
                $table->string('apellido_materno', 20);
                $table->boolean('sexo');
                $table->char('curp', 18);
                $table->string('clave_secundaria', 50);
                $table->decimal('promedio_secundaria', 5, 2);
                $table->date('fecha_egreso');                
                $table->string('beca', 100)->default("NINGUNA");
                $table->string('servicio_medico', 100)->defualt("NINGUNO");
                $table->string('domicilio', 200);                
                $table->string('estado', 50)->index();                
                $table->char('cp', 6)->index();                
                $table->string('email', 50);                
                $table->char('telefono', 10);                
                $table->char('tipo_sangre', 5)->default("NA");                
                $table->string('alergia', 50)->default("NINGUNA");                
                $table->string('nombre_padre', 100);                
                $table->string('ocupacion_padre', 100);
                $table->mediumText('trabajo_padre', 100);
                $table->date('fecha_alta');
                $table->boolean('usa_computadora');         
                $table->string('nivel_computadora', 20);
                $table->boolean('apoyo_familiar');                   
                $table->smallInteger('hijos')->default(0);
                $table->string('lugar_trabajo', 50)->default("NO TRABAJA");
                $table->boolean('aporta_casa');
                $table->string('bachillerato', 80);
                $table->tinyInteger('semestres_bachillerato');
                $table->decimal('ingreso_semanal', 6, 2);
                $table->string('horario_trabajo', 80);
                $table->smallInteger('personas_dependen')->default(0);
                $table->boolean('pc_trabajo');
                $table->boolean('pc_familiares');
                $table->date('created_at');
                $table->date('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('alumnos');
    }
}
