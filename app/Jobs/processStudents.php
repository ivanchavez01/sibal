<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Doc911;
use App\Alumnos;
use App\Municipios;
use App\Estados;
use App\Alergias;
use App\Secundarias;
use App\Discapacidades;
use App\Etnias;


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
        $alumnos = new Alumnos();
        $this->data["student"] = $this->data["student"]->get();
        $alumnos->usuario_sibal     = $this->data["student"]->data->usuario;
        $alumnos->ID_Municipio      = Municipios::where(["nombre_municipio" => $this->data["student"]->data->municipio])->get()[0]->ID_Municipio;
        $alumnos->ID_estado         = Estados::where(["nombre_estado" => $this->data["student"]->data->estado])->get()[0]->ID_Estado;
        $alumnos->ID_alergias       = Alergias::FindOrCreate($this->data["student"]->data->tipo_alergia);
        $alumnos->ID_secundaria     = Secundarias::FindOrCreate($this->data["student"]->data->secundaria, $this->data["student"]->data->clave_secundaria);
        $alumnos->ID_discapacidad   = Discapacidades::FindOrCreate($this->data["student"]->data->tipo_discapacidad);
        
        $alumnos->ID_Plan           = $this->data["config"]->plan_id;
        $alumnos->ID_Ciclo          = $this->data["config"]->ciclo_id;
        $alumnos->NoExpediente      = Alumnos::NewExpediente($this->data["config"]->ciclo_id, $plantel = 24);
        
        $alumnos->etnia             = 0; //Etnias::FindOrCreate($this->data->data->nombre_etnia);
        $alumnos->beca              = $this->data["student"]->data->tipo_beca;
        $alumnos->nombre_alumno     = $this->data["student"]->data->nombre;
        $alumnos->ap_paterno        = $this->data["student"]->data->apellido_paterno;
        $alumnos->ap_materno        = $this->data["student"]->data->apellido_paterno;
        $alumnos->sexo              = ($this->data["student"]->data->sexo == "MASCULINO") ? 1 : 0;
        $alumnos->curp              = $this->data["student"]->data->data->curp;
        $alumnos->cantidad_hijos    = $this->data["student"]->data->hijos;
        $alumnos->domicilio         = $this->data["student"]->data->domicilio;
        $alumnos->colonia           = $this->data["student"]->data->colonia;
        $alumnos->telefono          = $this->data["student"]->data->telefono;
        $alumnos->email             = $this->data["student"]->data->email;
        $alumnos->cp                = $this->data["student"]->data->cp;
        $alumnos->nombrePadre       = $this->data["student"]->data->nombre_padre;
        $alumnos->nombreMadre       = $this->data["student"]->data->nombre_madre;
        $alumnos->ocupacionPadre    = $this->data["student"]->data->ocupacion_padre;
        $alumnos->trabajoAlumno     = $this->data["student"]->data->lugar_trabajo;
        $alumnos->horarioTrabajoAlum= $this->data["student"]->data->horario_trabajo;
        $alumnos->Alum_ingreso      = $this->data["student"]->data->ingreso_semanal;
        $alumnos->personas_dependientes = $this->data["student"]->data->personas_que_dependen;
        $alumnos->servicio_medico   = $this->data["student"]->data->nombre;
        $alumnos->tipo_sangre       = $this->data["student"]->data->tipo_sangre;
        $alumnos->promedio          = $this->data["student"]->data->promedio;
        $alumnos->semestre_bachillerato = $this->data["student"]->data->semestres_bachillerato;
        $alumnos->plantel           = 24;
        $alumnos->internet_trab     = $this->data["student"]->data->pc_en_el_trabajo;
        $alumnos->internet_fam      = $this->data["student"]->data->pc_con_familiares;
        $alumnos->nivel_PC          = $this->data["student"]->data->manejo_computadora;
        $alumnos->apoyo_fam         = $this->data["student"]->data->apoyo_familiar;
        $alumnos->status            = 1;
        $alumnos->fecha_nac         = $this->data["student"]->data->fecha_nacimiento;
        $alumnos->fecha_ingreso_sibal= $this->data["student"]->data->fecha_alta;
        $alumnos->aporta_casa = $this->data["student"]->data->aportacion;
        $alumnos->lugar_trabajo_padre = $this->data["student"]->data->lugar_trabajo_padre;
        $alumnos->img = $this->data["student"]->data->usuario.".jpg";
        dd($alumnos);
        //$alumnos->save();
    }
}
