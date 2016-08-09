<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Alumnos;

class test extends Controller
{
    public function expediente() {
        $expediente = Alumnos::NewExpediente($ciclo_id = '188');
        dd($expediente);
    }

    public function municipio(){
        \App\Discapacidades::FindOrCreate('No Hay');
    }
}
