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
}
