<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    public $table = "municipios";
    public $primaryKey = "ID_Municipio";

    public function scopeFindOrCreate($query, $where){
        dd($query->where(["nombre_municipio" => $where])->get());
    }
}
