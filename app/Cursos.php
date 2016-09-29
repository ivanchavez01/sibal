<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    public $table = "cursos";
    public $primaryKey = "ID_Curso";

    public function Materia() {
        $this->hasOne('App\Materias');
    }

    public function scopeFindActiveOrCreate($query, $data) {
        $cursoExist = $query->where($data)->get();
        if(count($cursoExist) > 0) {
            return $cursoExist[0]->ID_Curso;
        } else {
            $curso = new \App\Cursos();
            $curso->ID_Materia = $data["ID_Materia"];
            $curso->ID_Empleado= $data["ID_Empleado"];
            $curso->ID_Ciclo   = $data["ID_Ciclo"];
            $curso->activo     = $data["activo"];
            $curso->save();

            return $curso->ID_Curso;
        }
    }
}
