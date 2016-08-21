<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    public $table = "municipios";
    public $primaryKey = "ID_Municipio";

   
    public function scopeFindOrCreate($query, $data) 
    {
        $municipios = $query->where(["nombre_municipio" =>$data]);
        if($municipios->count() > 0) {   
            return $municipios->get()[0]->ID_Municipio;
        } else {
            $municipio = new municipios();
            $municipio->nombre_municipio = $data;
            $municipio->save();
            return $municipio->ID_Municipio;
        }
    }
}
