<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Doc911;
//use App\alumnos;

class processStudents extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;

    public function __construct(Doc911 $doc911)
    {
        $this->data = $doc911->data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
    {
        $alumnos = \App\alumnos::like(["nombre" => "ivan"])->get();
        /*$alumnos->usuario_sibal = $this->data->usuario;
        $alumnos->nombre = $this->data->nombre;*/
        //$alumnos->save();
    }
}
