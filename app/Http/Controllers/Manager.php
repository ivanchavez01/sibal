<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\processStudents;
use App\Http\Requests;

use App\Doc911;
use App\DocCalf;
use App\Teachers;
use App\Ciclos;

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
      if($this->use_queues)
      {
          $doc911 = Doc911::where(["lot_id" => "2"])->firstOrFail();

          if($doc911->count() > 0)
          {
                foreach($doc911->get() as $student) 
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
