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

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
    {
        $alumnos = new \App\alumnos();
       
        $alumnos->usuario_sibal = $this->data->data->usuario;
        $alumnos->ID_Municipio = 1;
        $alumnos->ID_edo_civil = 1;
        $alumnos->ID_estado = 1;
        $alumnos->ID_alergias = 1;
        $alumnos->ID_secundaria = 1;
        $alumnos->ID_discapacidad = 1;
        $alumnos->ID_Plan = $this->data->plan_id;
        $alumnos->ID_Ciclo = $this->data->ciclo_id;
        $alumnos->NoExpediente = App/Alumnos::NewExpediente($this->data->ciclo_id);
        
        $alumnos->etnia = 1;
        $alumnos->beca = 1;
        $alumnos->nombre_alumno = $this->data->data->nombre;
        $alumnos->ap_paterno = $this->data->data->apellido_paterno;
        $alumnos->ap_materno = $this->data->data->apellido_paterno;
        $alumnos->sexo = ($this->data->data->sexo == "MASCULINO") ? 1 : 0;
        $alumnos->curp = $this->data->data->data->curp;
        $alumnos->cantidad_hijos = $this->data->data->hijos;
        $alumnos->domicilio = $this->data->data->domicilio;
        $alumnos->colonia = $this->data->data->colonia;
        $alumnos->telefono = $this->data->data->telefono;
        $alumnos->email = $this->data->data->email;
        $alumnos->cp = $this->data->data->cp;
        $alumnos->nombrePadre = $this->data->data->nombre_padre;
        $alumnos->nombreMadre = $this->data->data->nombre_madre;
        $alumnos->ocupacionPadre = $this->data->data->ocupacion_padre;
        $alumnos->trabajoAlumno = $this->data->data->lugar_trabajo;
        $alumnos->horarioTrabajoAlum = $this->data->data->horario_trabajo;
        $alumnos->Alum_ingreso = $this->data->data->ingreso_semanal;
        $alumnos->personas_dependientes = $this->data->data->personas_que_dependen;
        $alumnos->servicio_medico = $this->data->data->nombre;
        $alumnos->tipo_sangre = $this->data->data->tipo_sangre;
        $alumnos->promedio = $this->data->data->promedio;
        $alumnos->semestre_bachillerato = $this->data->data->semestres_bachillerato;
        $alumnos->plantel = 0;
        $alumnos->internet_trab = $this->data->data->pc_en_el_trabajo;
        $alumnos->internet_casa = 0;
        $alumnos->internet_fam = $this->data->data->pc_con_familiares;
        $alumnos->nivel_PC = $this->data->data->manejo_computadora;
        $alumnos->apoyo_fam = $this->data->data->apoyo_familiar;
        $alumnos->status = 1;
        $alumnos->fecha_nac = $this->data->data->fecha_nacimiento;
        $alumnos->fecha_ingreso = '';
        $alumnos->fecha_ingreso_sibal = $this->data->data->fecha_alta;
        
        $alumnos->aporta_casa = $this->data->data->aportacion;
        
        $alumnos->lugar_trabajo_padre = $this->data->data->lugar_trabajo_padre;
        $alumnos->img = $this->data->data->data->usuario.".jpg";
        $alumnos->save();
    }
}
