<table width="100%">
    <tr>
        <td width="20%">
            <img src="{{storage_path('app/public/logo_cobach.png')}}" alt="test alt attribute" width="100" height="70" border="0" />
        </td>
        <td width="60%" align="center" style="font-size:15px;">
            COLEGIO DE BACHILLERES <br>
            DEL ESTADO DE SONORA <br>
            
            <h3>SISTEMA DE BACHILLERATO EN LINEA</h3>
                CICLO ESCOLAR {{$this->ciclo}} <br>
                <b>Acta de Evaluaci&oacute;n</b>    Ordinario
        </td>
        <td width="20%">
        
        </td>
    </tr>
</table> 
<hr>

<table width="100%" style="font-size:11px;">
    <tr>
        <td width="20%"><b>PLANTEL:</b></td>
        <td width="60%">SISTEMA DE BACHILLERATO EN LINEA</td>
        <td width="20%"><b>FECHA:</b> {{$this->fecha}}</td>
    </tr>
    <tr>
        <td width="20%"><b>PROFESOR:</b></td>
        <td width="60%">{{$this->maestro}}</td>
        <td width="20%"></td>
    </tr>
    <tr>
        <td width="20%"><b>CURSO:</b></td>
        <td width="60%">{{$this->id_materia}} {{$this->curso}}</td>
        <td width="20%"></td>
    </tr>
</table><hr> <br>

<table width="100%" style="font-size:10px;" >
    <tr>
        <td width="10%" style="border-bottom:1px solid #000;"></td>
        <td width="20%" style="border-bottom:1px solid #000;"><b>EXPEDIENTE</b></td>
        <td width="45%" style="border-bottom:1px solid #000;"><b>NOMBRE</b></td>
        <td width="15%" style="border-bottom:1px solid #000;"></td>
        <td width="10%" style="border-bottom:1px solid #000;"><b>CALIF.</b></td>
    </tr>
    @foreach($alumnos as $alumno)
    <tr>
        <td style="border-bottom:1px solid #000;">'.($i + 1).'</td>
        <td style="border-bottom:1px solid #000;">'.$this->table[$i]["no_exp"].'</td>
        <td style="border-bottom:1px solid #000;">'.$this->table[$i]["nombre"].'</td>
        <td style="border-bottom:1px solid #000;">'.($i + 1).'</td>
        <td style="border-bottom:1px solid #000;" align="center">'.$calf.'</td>
    </tr>
    @endforeach
    <tr>
        <td></td>
        <td></td>
        <td align="center"><b>SUMATORIA: </b></td>
        <td></td>
        <td align="center"><b>'.$sum.'</b></td>
    </tr>
</table>

<br><br><br>
<table width="100%" style="font-size:11px;">
    <tr align="center">
        <td width="40%">						
            DRA. GUADALUPE GONZALEZ RAMIREZ<br>
            <b>COORDINADORA DE SIBAL</b>
        </td>
        <td width="20%"></td>
        <td width="40%">
    
            {{$this->maestro}}<br>
            <b>PROFESOR</b> 
        </td>
    </tr>					
</table>