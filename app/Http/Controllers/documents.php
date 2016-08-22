<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Excel;
use PDF;

class Documents extends Controller
{
    public function actas(){
        $alumno_id = ["1440", "1439", "1438"];
        $alumnos = \App\Alumnos::find($alumno_id);
        return view("documentos.actas", ["alumnos" => $alumnos]);
    }
    public function certificados($id){
        
        $alumno_id = [$id];       
        $alumnos = \App\Alumnos::find($alumno_id);
        $pdf = PDF::loadView('documentos.certificados', [
            "alumnos" => $alumnos,
            "fecha_expedicion" => date("Y-m")."-08"
        ]);

        return $pdf->stream();
       
    }
}
