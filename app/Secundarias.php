<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secundarias extends Model
{
    

    public function scopeFindOrCreate($query, $nombre_sec, $clave_sec) 
    {
        $secundaria = $query->where(["nombre_secundaria" => $data]);
        
        if($secundaria->count() > 0) { 
            return $secundaria->get()[0]->ID_secundaria;
        } else {
            $secundaria = new Secundarias();
            $secundaria->nombre_secundaria = $data;
            $secundaria->save();
            return $secundaria->ID_secundaria;
        }
    }
}
