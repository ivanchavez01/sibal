<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\processStudents;
use App\Http\Requests;
use App\Doc911;

class Manager extends Controller
{
    public $use_queues = true;

    public function index($id)
    {
        $StudentsTmp = \App\Doc911::where(["lot_id" => $id])->get();
        return view('manager.index', ['students' => $StudentsTmp]);
    }

    public function processStudents(Request $req)
    {
      if($this->use_queues)
      {
          //implement queues: TODO
          $doc911 = Doc911::where(["lot_id" => 2])->firstOrFail();
         
          foreach($doc911->get() as $student) 
          {
            $job = (new processStudents($doc911))->delay(5);
            $this->dispatch($job);
          }
      }
      else 
      {
        $this->processStaticStudents($req);
      }
    }

    public function processStaticStudents(Request $req)
    {

    }

}
