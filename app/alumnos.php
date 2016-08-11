<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Expediente;
use App\Ciclos;
use Log;

class Alumnos extends Model
{
    public $table = "alumnos";
    public $primaryKey = "ID_alumno";


    public function Expediente() {
        return $this->hasMany("App\Expediente");
    }

    public function scopeNewExpediente($query, $ciclo, $plantel = "24") {
        //ciclo,plantel,autoincrement(3 digitos)
        //ej 1312-24-0001
        $ciclo = Ciclos::find($ciclo);
        
        if($ciclo->count() > 0)
        {
            $expediente_format  = date('ym', strtotime($ciclo->nombre_ciclo)).$plantel;
            $expediente   = Alumnos::where("Noexpediente", "LIKE", $expediente_format."%")->take(1)->orderBy("Noexpediente", "desc");
        
            if($expediente->count() > 0)
            {
                //si existe expediente con el ciclo asignado
                //iniciar el consecutivo en el ultimo expediente
                $expediente     = $expediente->get();
                $noexpediente   = $expediente[0]->Noexpediente;
                $last_increment = substr($noexpediente, strlen($noexpediente) -3, 3);
                $newExpediente  = $expediente_format.(str_pad($last_increment + 1, 3, "0", STR_PAD_LEFT));
                return $newExpediente;
            }
            else
            {
                return $expediente_format.str_pad("1", 3, "0", STR_PAD_LEFT);
            }
        }
    }
}
