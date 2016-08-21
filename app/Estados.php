<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    public $table = "estados";
    public $primaryKey = "ID_Estado";

    public function scopeFindOrCreate($query, $data) 
    {
        $entity = $query->where(["nombre_estado" =>$data]);
        if($entity->count() > 0) {   
            return $entity->get()[0]->ID_Estado;
        } else {
            $estado = new Estados();
            $estado->nombre_estado = $data;
            $estado->save();
            return $municipio->ID_Estado;
        }
    }
}
