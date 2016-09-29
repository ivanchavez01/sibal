<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Alumnos;

class test extends Controller
{
    public function expediente() {
        $expediente = Alumnos::NewExpediente($ciclo_id = '126');
        dd($expediente);
    }

    public function municipio(){
        $doc911 = \App\Doc911::where(["lot_id" => 2])->firstOrFail()->get();

        if(count($doc911) > 0)
        {
            foreach($doc911 as $student) 
            {
                $req = [
                    "ciclo_id" => "191",
                    "lot_id"   => 2,
                    "metters"  => [
                          ["metter_id" => "1", "teacher_id" => "25"],
                          ["metter_id" => "2", "teacher_id" => "26"]
                    ],
                    "plan_id"  => "1"
                ];

                $data = ["student" => $student, "config" => $req];
                $handler = new \App\Libraries\HandlerStudent();
                $handler->process($data);
                
            }
        }
    }
}
