<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secundarias extends Model
{
    

    public function scopeFindOrCreate($query, $nombre_sec, $clave_sec) 
    {
        $filters = ["nombre_secundaria" => $nombre_sec, "clave_secundaria" => $clave_sec];
        $secundaria = $query->where($filters);
        
        if($secundaria->count() > 0) { 
            return $secundaria->get()[0]->ID_Secundaria;
        } else {
            $secundarias = new Secundarias();
            $secundarias->nombre_secundaria  = $nombre_sec;
            $secundarias->clave_secundaria   = $clave_sec;
            $secundarias->save();
            return $secundarias->ID_Secundaria;
        }
    }
}
