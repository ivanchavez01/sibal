<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\processStudents;
use App\Http\Requests;

use App\Doc911;
use App\DocCalf;
use App\Teachers;
use App\Ciclos;
use DB;
use App\Services\WebSocket\Client;

class Manager extends Controller
{
    public $use_queues = true;
    public $data;

    public function index($id)
    {   
        $StudentsTmp    = \App\Doc911::where(["lot_id" => $id])->get();
        $matters        = DocCalf::onlyMatters()->get();
        $teachers       = Teachers::all();
        $ciclos         = Ciclos::where(["activo" => 1]);
     
        return view('manager.index', [
            "students"  => $StudentsTmp, 
            "matters"   => $matters,
            "teachers"  => $teachers,
            "ciclos"    => $ciclos,
            "lot_id"    => $id
        ]);
    }

    public function processStudents(Request $req)
    {
        ini_set('xdebug.max_nesting_level', 1000);
        if($this->use_queues)
        {
            $doc911 = Doc911::where(["lot_id" => $req->input("lot_id")])->firstOrFail()->get();

            if(count($doc911) > 0)
            {
                //inactivamos cursos y creamos nuevos
                DB::table("cursos")->where(["activo" => 1])->update(["activo" => 0]);

                foreach($doc911 as $student) 
                {
                    $data = ["student" => $student, "config" => $req->all()];                    
                    $job = (new processStudents($data))->delay(5);
                    $this->dispatch($job);
                }
            }
        }
        else 
        {
            $this->processStaticStudents($req);
        }
    }

    public function processStaticStudents(Request $req)
    {
        //not implements
    }
}
