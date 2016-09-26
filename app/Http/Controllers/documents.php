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

    public function certificado($id){
        
        $alumno_id = [$id];       
        $alumnos = \App\Alumnos::find($alumno_id);
        
        if($alumnos) {
            $pdf = PDF::loadView('documentos.certificados', [
                "alumnos" => $alumnos,
                "fecha_expedicion" => date("Y-m")."-19"
            ]);

            $pathPDF = storage_path('certificados/');
            if(!is_dir($pathPDF)) { mkdir($pathPDF); }
            
            $pdf->setPaper('A4', 'portrait')->save($pathPDF.$alumnos[0]->Noexpediente.'.pdf');

            //return response()->json(["status" => "success"]);
        }
    }

    public function certificados(Request $req) {
        if(!empty($req->input("students"))) {
            foreach($req->input("students") as $index => $value) {
                if($value)
                    $this->certificado($index);
            }
        }
    }


}
