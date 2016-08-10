<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secundarias extends Model
{
    

    public function scopeFindOrCreate($query, $nombre_sec, $clave_sec) 
    {
        $filters = ["nombre_secundaria" => $nombre_sec, "clave" => $clave_sec];
        $secundaria = $query->where($filters);
        
        if($secundaria->count() > 0) { 
            return $secundaria->get()[0]->ID_secundaria;
        } else {
            $secundaria = new Secundarias();
            $secundaria->nombre_secundaria  = $filters["nombre_secundaria"];
            $secundaria->clave              = $filters["clave"];
            $secundaria->save();
            return $secundaria->ID_secundaria;
        }
    }
}
