<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
html{ font-size:14px; padding-bottom:0px; margin-bottom:0px; margin-left:2px; margin-right:20px; font-family: 'helvetica'; }
.calificaciones td{ padding-top:0px; padding-bottom: -1px; }
img { width: 150px; }
.thead td { font-size: 16px; font-weight:bolder; }
.nombre-alumno{ 
    font-size:18px;
    font-weight: bold;
    margin-top: 0px;
    margin-bottom: 10px;
}
</style>
@if($alumnos->count() > 0)
    @foreach($alumnos as $alumno)
    <br>
    <br>
    <br>
    <br>
    
    
        <table width="100%" cellspacing="0" cellspadding="0" style="margin-bottom:10px;">
            <tr>
                <td align="center">
                    <b style="font-size:12px;">CLAVE DEL CENTRO DE TRABAJO: 26ECB1024P </b><br><br>
                </td>
            </tr>
            <tr>
                <td align="justify">
                    LA DIRECCION GENERAL CERTIFICA, QUE SEGUN CONSTANCIAS QUE OBRAN EN EL ARCHIVO DE ESTE PLANTEL, {!! ($alumno->sexo == "1") ? "EL ALUMNO": "LA ALUMNA"!!}:
                </td>
            </tr>
            <tr>
                <td align="center">
                    <div class="nombre-alumno">
                        {{$alumno->nombre_alumno}} {{$alumno->ap_paterno}} {{$alumno->ap_materno}}
                    </div>
                </td>
            </tr>
            <tr>
                <td align="justify">
                    CON EXPEDIENTE {{$alumno->Noexpediente}}, CURSO {{($alumno->Expediente->count() >= 42) ? "TOTALMENTE" : "PARCIALMENTE"}} EL PLAN DE ESTUDIOS DE EDUCACION MEDIA SUPERIOR EN LINEA, OBTENIENDO LAS CALIFICACIONES QUE A CONTINUACION SE ANOTAN:
                </td>
            </tr>
        </table>

        <table width="100%" style="font-size:9.5px;">
            <tr>
                <td width="28%" valign="top">
                    <div class="imagen" style="height:180px; width:160px; color:#FFF;">                        
                        <img src="{{storage_path('app/public/students/'.$alumno->img)}}"  alt="{{$alumno->img}}" border="0" />
                    </div>
                    <br><br><br><br><br><br><br><br><br><br><br><br>
                    <br><br><br><br><br><br><br><br>
                    <div style="font-size:8px !important; text-align:center;">
                        Vo. Bo <br>
                        JEFE DEL DEPARTAMENTO DE <br>
                        CONTROL ESCOLAR
                        <br><br><br><br><br><br><br><br>
                        LIC. MARCO ANTONIO LEYVA RUIZ
                        <br>
                    </div>
                </td>
                <td width="72%">
                    <table border="1" cellspacing="0" cellspadding="0" class="calificaciones">
                        <tr class="thead">
                            <td width="20%" valign="top"><b style="font-size:13.5px;">MODULO</b> </td>
                            <td width="14%" valign="top"><b style="font-size:13.5px;">CLAVE</b></td>
                            <td width="56%" valign="top"><b style="font-size:13.5px;">ASIGNATURAS</b></td>
                            <td width="10%" valign="top"><b style="font-size:13.5px;">CALIF</b></td>
                        </tr>
                        @if($alumno->Expediente)
                            <?php $i = 1; $modulo_id = 0; ?>
                            @foreach($alumno->Expediente as $expediente)                        
                                <tr>
                                    @if($modulo_id != $expediente->Materia->Modulo->ID_Modulo)
                                        <?php $modulo_id = $expediente->Materia->Modulo->ID_Modulo; ?>
                                        <td valign="top" rowspan="{{$expediente->Materia->Modulo->Materias->count()}}">
                                            {{$expediente->Materia->Modulo->nombre_modulo}}
                                        </td>                            
                                    @endif
                                    <td valign="top">{{trim($expediente->Materia->clave_materia)}}</td>
                                    <td valign="top">{{trim($expediente->Materia->nombre_materia)}}</td>
                                    <td valign="top" align="center">{{$expediente->calif}}</td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        @endif
                    </table>
                    <table width="100%" style="margin-top:-5px">
                        <tr>
                            <td width="25%"></td>
                            <td width="10%"></td>
                            <td width="55%" align="center" valign="top"> <b style="font-size:14px;">PROMEDIO: </b></td>
                            <td width="10%" align="center" valign="top"><b>{{$alumno->Promedio()}}</b></td>
                        </tr>
                    </table>
                </td>			
            </tr>		
        </table>
        <br>
        <br>
        <br>
        <br>
        
        <table width="100%" style="font-size:13px;">		
			<tr>
				<td align="justify">
                    {{--*/
                        $numberToString = new \App\Libraries\NumberToString();
                    /*--}}
                    <p>
                        SE EXTIENDE EL PRESENTE CERTIFICADO QUE AMPARA 
                        <b>{{$alumno->Expediente->count()}} {{$numberToString->numtoletras($alumno->Expediente->count())}} </b> ASIGNATURAS APROBADAS CON LO QUE ACREDITA {{($alumno->Expediente->count() == 42) ? "INTEGRAMENTE" : "PARCIALMENTE"}} 
                         SUS ESTUDIOS EN EDUCACION MEDIA SUPERIOR EN HERMOSILLO, SONORA, MEXICO, EL DIA 
                        {{strtoupper($numberToString->fechaALetras($fecha_expedicion))}}.</p></td>				
			</tr>
			<tr>
				<td align="center">
					
					DIRECTOR GENERAL
					<br><br><br><br><br><br><br>
					<b>MTRO. VICTOR MARIO GAMIÑO CASILLAS</b>
				</td>				
			</tr>		
		</table>
    @endforeach
@endif

</html>