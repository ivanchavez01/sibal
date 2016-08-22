<?php
namespace App\Libraries;

use Log;
use App\Doc911;
use App\DocCalf;
use App\Alumnos;
use App\Cursos;
use App\Municipios;
use App\Estados;
use App\Alergias;
use App\Secundarias;
use App\Discapacidades;
use App\Etnias;
use App\Expediente;
use App\Materias;
use DB;

class HandlerStudent 
{
    public $data;
    public function process($data) 
    {
        $this->data = $data;
        DB::beginTransaction();

        $alumno = new Alumnos();
        $this->data["student"]->data= json_decode($this->data["student"]->data, TRUE);
        
        $alumno->usuario_sibal     = $this->data["student"]->data["usuario"];
        $alumno->ID_Municipio      = Municipios::FindOrCreate($this->data["student"]->data["municipio"]);
        $alumno->ID_estado         = Estados::FindOrCreate($this->data["student"]->data["estado"]);
        $alumno->ID_alergias       = Alergias::FindOrCreate($this->data["student"]->data["tipo_alergia"]);
        $alumno->ID_secundaria     = Secundarias::FindOrCreate($this->data["student"]->data["secundaria"], $this->data["student"]->data["clave_secundaria"]);
        $alumno->ID_discapacidad   = Discapacidades::FindOrCreate($this->data["student"]->data["tipo_discapacidad"]);
        
        $alumno->ID_Plan           = $this->data["config"]["plan_id"];
        $alumno->ID_Ciclo          = $this->data["config"]["ciclo_id"];
        $alumno->NoExpediente      = Alumnos::NewExpediente($this->data["config"]["ciclo_id"], $plantel = 24);
        
        
        Log:info("Creando alumno en el ciclo ".$this->data["config"]["ciclo_id"]." se genero el expediente: ".$alumno->NoExpediente);


        $alumno->etnia             = "0"; //Etnias::FindOrCreate($this->data->data->nombre_etnia);
        $alumno->beca              = $this->data["student"]->data["tipo_beca"];
        $alumno->nombre_alumno     = $this->data["student"]->data["nombre"];
        $alumno->ap_paterno        = $this->data["student"]->data["apellido_paterno"];
        $alumno->ap_materno        = $this->data["student"]->data["apellido_materno"];
        $alumno->sexo              = ($this->data["student"]->data["sexo"] == "MASCULINO") ? 1 : 0;
        $alumno->curp              = $this->data["student"]->data["curp"];
        $alumno->cantidad_hijos    = (!is_integer($this->data["student"]->data["hijos"])) ? 0 : $this->data["student"]->data["hijos"];
        $alumno->domicilio         = $this->data["student"]->data["domicilio"];
        $alumno->telefono          = $this->data["student"]->data["telefono"];
        $alumno->email             = $this->data["student"]->data["email"];
        $alumno->cp                = $this->data["student"]->data["cp"];
        $alumno->nombrePadre       = $this->data["student"]->data["nombre_padre"];
        $alumno->nombreMadre       = $this->data["student"]->data["nombre_madre"];
        $alumno->ocupacionPadre    = $this->data["student"]->data["ocupacion_padre"];
        $alumno->trabajoAlumno     = $this->data["student"]->data["lugar_trabajo"];
        $alumno->horarioTrabajoAlum= $this->data["student"]->data["horario_trabajo"];
        $alumno->Alum_ingreso      = $this->data["student"]->data["ingreso_semanal"];
        $alumno->personas_dependientes = $this->data["student"]->data["personas_que_dependen"];
        $alumno->servicio_medico   = $this->data["student"]->data["tipo_servicio_medico"];
        $alumno->tipo_sangre       = $this->data["student"]->data["tipo_sangre"];
        $alumno->promedio          = $this->data["student"]->data["promedio"];
        $alumno->semestre_bachillerato = $this->data["student"]->data["bachillerato"];        
        $alumno->plantel           = 24;
        $alumno->internet_trab     = $this->data["student"]->data["pc_en_el_trabajo"];
        $alumno->internet_fam      = $this->data["student"]->data["pc_con_familiares"];
        $alumno->nivel_PC          = $this->data["student"]->data["manejo_computadora"];
        $alumno->apoyo_fam         = $this->data["student"]->data["apoyo_familiar"];

        $alumno->fecha_nac         = $this->data["student"]->data["fecha_nacimiento"]["date"];
        $alumno->fecha_ingreso_sibal= $this->data["student"]->data["fecha_alta"]["date"];
        $alumno->aporta_casa       = $this->data["student"]->data["aportacion"];
        $alumno->lugar_trabajo_padre= $this->data["student"]->data["lugar_trabajo_padre"];
        $alumno->img               = $this->data["student"]->data["usuario"].".jpg";
        $alumno->save();

        if(!isset($this->data["config"]["metters"]) OR empty($this->data["config"]["metters"])) {
            DB::rollBack();
        }

        foreach($this->data["config"]["metters"] as $metters)
        {
            if(strlen($metters["metter_id"]) < 8) {
                $metters["metter_id"] = "0".$metters["metter_id"];
            }

            $materia = \App\Materias::find($metters["metter_id"]);

            if($materia)
            {
                $expediente = \App\DocCalf::where(["matters_id" => $materia->clave_materia]);
                
                if($expediente->count() > 0)
                {
                    $expediente = $expediente->get()[0];                    
                    $expediente->data = json_decode($expediente->data);
                    
                    //si la clave de la materia es menor a 8 digitos
                    //es porque el procesador de excel le elimino el cero al principio
                    if(strlen($expediente->matters_id) < 8) {
                        $expediente->matters_id = "0".$expediente->matters_id;
                    }

                    //buscar materia procesada y guardar el ultimo maestro que impartio esa materia                    
                    $materia = Materias::find((int)$metters["metter_id"]);
                    $materia->ID_Empleado_Default = (int)$metters["teacher_id"];
                    $materia->save();
                    
                    //Crear un nuevo curso
                    $curso = new Cursos();
                    $curso->ID_Materia  = $materia->ID_Materia;
                    $curso->ID_Empleado = $metters["teacher_id"];
                    $curso->ID_Ciclo    = $this->data["config"]["ciclo_id"];
                    $curso->activo      = 1;
                    $curso->save();
                    $curso_id = $curso->ID_Curso;
                    
                    $alumno->Expediente = new Expediente();
                    $alumno->Expediente->ID_Alumno  = $alumno->ID_alumno;
                    $alumno->Expediente->ID_Materia = $materia->ID_Materia;
                    $alumno->Expediente->calif      = $expediente->data->calificacion;
                    $alumno->Expediente->ID_Curso   = $curso_id;
                    $alumno->Expediente->tipo_calificacion = ($expediente->data->revalidada == "NO") ? 0 : 1;                    
                    $alumno->Expediente->save();

                    DB::commit();
                }
                else
                {
                    DB::rollBack();
                }
            }
            else
            {
                DB::rollBack();
            }
            
        }
    }


}

?>