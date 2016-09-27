<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secundarias extends Model
{
    public $table = "secundarias";
    public $primaryKey = "ID_Secundaria";

    public function scopeFindOrCreate($query, $nombre_sec, $clave_sec) 
    {
        $filters = ["clave_secundaria" => $clave_sec];
        $secundaria = $query->where($filters)->get();
        
        if(count($secundaria) > 0) {
            return $secundaria[0]->ID_Secundaria;
        } else {
            $secundarias = new Secundarias();
            $secundarias->nombre_secundaria  = $nombre_sec;
            $secundarias->clave_secundaria   = $clave_sec;
            $secundarias->save();
            return $secundarias->ID_Secundaria;
        }
    }
}
