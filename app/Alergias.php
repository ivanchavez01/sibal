<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alergias extends Model
{
    public $table = "alergias";
    public $primaryKey = "ID_Alergia";
    public $timestamps = false;

    public function scopeFindOrCreate($query, $data) {
        $alergias = $query->where(["nombre_alergia" =>$data])->get();
        
        if(count($alergias) > 0) {   
            return $alergias[0]->ID_Alergia;
        } else {
            $alergia = new Alergias();
            $alergia->nombre_alergia = $data;
            $alergia->save();
            return $alergia->ID_Alergia;
        }
    }
}
