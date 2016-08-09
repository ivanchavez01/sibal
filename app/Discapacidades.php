<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discapacidades extends Model
{
    public $table = "discapacidades";
    public $primaryKey = "ID_Discapacidad";
    public $timestamps = false;
    
    public function scopeFindOrCreate($query, $data) 
    {
        $discapacidad = $query->where(["nombre_discapacidad" => $data]);
        
        if($discapacidad->count() > 0) { 
            return $discapacidad->get()[0]->ID_Discapacidad;
        } else {
            $discapacidad = new Discapacidades();
            $discapacidad->nombre_discapacidad = $data;
            $discapacidad->save();
            return $discapacidad->ID_Discapacidad;
        }
    }
}
