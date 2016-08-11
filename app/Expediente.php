<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Alumnos;

class Expediente extends Model
{
    public $table = "Expediente";
    public $primaryKey = "ID_Expediente";

    public function Alumno() {
        return $this->belongsTo("App\Alumnos");
    }

    public function Materia(){
        return $this->belongsTo("App\Materias", 'ID_Materia');
    }
}
