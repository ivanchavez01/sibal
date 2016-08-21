<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
html{ font-size:13px; padding-bottom:0px; margin-bottom:0px; }
.calificaciones td{ padding: 0px; }
</style>
@if($alumnos->count() > 0)
    @foreach($alumnos as $alumno)
    <br>
    <br>
    <br>
    
        <table width="100%">
            <tr>
                <td align="center">
                    <b style="font-size:12px;">CLAVE DEL CENTRO DE TRABAJO: 26ECB1024P </b><br><br>
                </td>
            </tr>
            <tr>
                <td align="justify">
                    LA DIRECCION GENERAL CERTIFICA, QUE SEGUN CONSTANCIAS QUE OBRAN EN EL ARCHIVO DE ESTE PLANTEL, {!! ($alumno->sexo == "1") ? "EL ALUMNO": "LA ALUMNA"!!}
                </td>
            </tr>
            <tr>
                <td align="center">
                    <h2 style="font-size:18px;">
                        {{$alumno->nombre_alumno}} {{$alumno->ap_paterno}} {{$alumno->ap_materno}}
                    </h2>
                </td>
            </tr>
            <tr>
                <td align="justify">
                    CON EXPEDIENTE {{$alumno->Noexpediente}}, CURSO {{($alumno->Expediente->count() >= 42) ? "TOTALMENTE" : "PARCIALMENTE"}} EL PLAN DE ESTUDIOS DE EDUCACION MEDIA SUPERIOR EN LINEA, OBTENIENDO LAS CALIFICACIONES QUE A CONTINUACION SE ANOTAN:
                </td>
            </tr>
        </table>

        <table width="100%" style="font-size:9px;">
            <tr>
                <td width="28%" valign="top">
                    <div class="imagen" style="background:#000; height:180px; width:160px;">
                        <img src="'.path_storage("app/public/students/".$this->img).'"  alt="test" width="41mm" height="48mm" border="0" >
                    </div>
                    <br><br><br><br><br><br><br><br><br><br><br><br>
                    <br><br><br><br><br><br><br><br>
                    <div style="font-size:9px; text-align:center;">
                        Vo. Bo <br>
                        JEFE DEL DEPARTAMENTO DE <br>
                        CONTROL ESCOLAR
                        <br><br><br><br><br><br><br><br><br>
                        LIC. MARCO ANTONIO LEYVA RUIZ
                        <br>
                    </div>
                </td>
                <td width="72%">
                    <table border="1" cellspacing="0" cellspadding="0" class="calificaciones">
                        <tr>
                            <td width="20%"><b style="font-size:12px;">MODULO</b> </td>
                            <td width="14%"><b style="font-size:12px;">CLAVE</b></td>
                            <td width="56%"><b style="font-size:12px;">ASIGNATURAS</b></td>
                            <td width="10%"><b style="font-size:12px;">CALIF</b></td>
                        </tr>
                        @if($alumno->Expediente)
                            <?php $i = 1; $modulo_id = 0; ?>
                            @foreach($alumno->Expediente as $expediente)                        
                                <tr>
                                    @if($modulo_id != $expediente->Materia->Modulo->ID_Modulo)
                                        <?php $modulo_id = $expediente->Materia->Modulo->ID_Modulo; ?>
                                        <td rowspan="{{$expediente->Materia->Modulo->Materias->count()}}">
                                            {{$expediente->Materia->Modulo->nombre_modulo}}
                                        </td>                            
                                    @endif
                                    <td>{{trim($expediente->Materia->clave_materia)}}</td>
                                    <td>{{trim($expediente->Materia->nombre_materia)}}</td>
                                    <td align="center">{{$expediente->calif}}</td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        @endif
                    </table>
                    <table width="100%">
                        <tr>
                            <td width="25%"></td>
                            <td width="10%"></td>
                            <td width="55%" align="center"> <b style="font-size:12px;">PROMEDIO: </b></td>
                            <td width="10%" align="center"><b>{{$alumno->Promedio()}}</b></td>
                        </tr>
                    </table>
                </td>			
            </tr>		
        </table>
        <br>
        <br>
        <br>
        <br>
        <br>
        <table width="100%" style="font-size:13px;">		
			<tr>
				<td align="justify">
                    <p>
                        SE EXTIENDE EL PRESENTE CERTIFICADO QUE AMPARA {{$alumno->Expediente->count()}}
                        <b>{{$alumno->Expediente->count()}} (con letra) </b> ASIGNATURAS APROBADAS CON LO QUE ACREDITA {{($alumno->Expediente->count() == 42) ? "INTEGRAMENTE" : "PARCIALMENTE"}} 
                         SUS ESTUDIOS EN EDUCACION MEDIA SUPERIOR EN HERMOSILLO, SONORA, MEXICO, EL DIA 
                        {{$fecha_expedicion}} (con letra).</p></td>				
			</tr>
			<tr>
				<td align="center">
					<br>
					DIRECTOR GENERAL
					<br><br><br><br>    
					<b>MTRO. VICTOR MARIO GAMIÑO CASILLAS</b>
				</td>				
			</tr>		
		</table>
    @endforeach
@endif

</html>