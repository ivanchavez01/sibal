<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
    public $table = "modulos";
    public $primaryKey = "ID_Modulo";

    public function Materias() {
        return $this->hasMany("App\Materias", 'ID_Modulo');
    }
}
