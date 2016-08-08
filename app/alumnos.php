<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class alumnos extends Model
{
    public $table = "alumnos";
    public $primaryKey = "alumno_id";

    public function scopeNewExpediente($query, $ciclo) {
        //ciclo,plantel,autoincrement(3 digitos)
        //ej 1312-24-0001
        $query = DB::get($this->table)::where(["NoExpediente" => '']);
    }
}
