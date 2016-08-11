<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materias extends Model
{
    public $table = "materias";
    public $primaryKey = "ID_Materia";

    public function Curso() {
        return $this->belongsTo("App\Cursos", 'ID_Materia');
    }

    public function Expedientes() {
        $this->hasMany("App\Expediente", 'ID_Materia');
    }

    public function Modulo() {
        return $this->belongsTo("App\Modulos", "ID_Modulo");
    }
}
