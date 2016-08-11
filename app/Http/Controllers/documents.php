<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Excel;
class documents extends Controller
{
    public function actas(){
        $alumno_id = ["1440", "1439", "1438"];
        $alumnos = \App\Alumnos::find($alumno_id);
        return view("documentos.actas", ["alumnos" => $alumnos]);
    }
    public function certificados(){
        $alumno_id = ['1363'];
        // $alumnos = \App\Alumnos::find($alumno_id);
               
        // return view("documentos.certificados", [
        //     "alumnos" => $alumnos,
        //     "fecha_expedicion" => date("Y-m-d")
        // ]);

        Excel::create('New file', function($excel) use($alumno_id) {
            $excel->sheet('New sheet', function($sheet) use($alumno_id) {
                $alumnos = \App\Alumnos::find($alumno_id);
               
                $sheet->loadView("documentos.certificados", [
                    "alumnos" => $alumnos,
                    "fecha_expedicion" => date("Y-m-d")
                ]);
            });
        })
        ->export("pdf");
       
    }
}
