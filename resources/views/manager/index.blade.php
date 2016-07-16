@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Configuraci&oacute;n de actas</h3>
        <br />

        <div class="row">
            <ul class="steps">
                <li class="active">
                    <div class="step-container">
                        <span>1</span>
                        <div class="step-text">
                            Configuraci&oacute;n plan de estudio y ciclo
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </li>
                <li>
                    <div class="step-container">
                        <span>2</span>
                        <div class="step-text">
                            Asignaci&oacute;n de maestros
                        </div> 
                        <div class="clearfix"></div>
                    </div>
                </li>
                <li>
                    <div class="step-container">
                        <span>3</span>
                        <div class="step-text">
                            Guardar Alumnos
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </li>
            </ul>
        </div>


        <div class="row">
            <div class="col-md-6">
                <h4>Alumnos</h4>
                <small>Se agregar&aacute;n {{count($students)}} alumnos. </small>
                <br /><br />

                @if(!empty($students))
                    <ul class="list-group">
                        {{--*/ $i = 1 /*--}} 
                        @foreach($students as $student)
                            <?php $dstudent = json_decode($student->data); ?>
                            <li class="list-group-item">
                               {{$i}} .- {{$dstudent->usuario}} - {{$dstudent->nombre}} {{$dstudent->apellido_paterno}} {{$dstudent->apellido_materno}} 
                            </li>
                            {{--*/ $i++ /*--}}
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-md-6">
                 <div>
                    <button class="btn btn-primary pull-right">
                        Siguiente >
                    </button>
                </div>
                <div class="clearfix"></div>

                <form name="configActas">
                    <div class="form-group">
                        <label for="#">
                            Plan de Estudios
                        </label>
                        <select name="sl_planEstudio" id="sl_planEstudio" class="form-control">
                            <option value="1">Plan de estudios 2009</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="#">
                            Ciclo Escolar
                        </label>
                        <div class="input-group">
                            <select name="sl_ciclo" id="sl_ciclo" class="form-control">
                                <option value="1">2013-08</option>
                            </select>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">{{trans('buttons.add_ciclo')}}</button>
                            </span>
                        </div>
                    </div>
                </form>


                <div class="alert alert-warning">
                    Nota: Los registros aun no est&aacute;n han sido salvados, se encuentran de manera temporal.
                </div>
            </div>
        </div>

       
    </div>
@stop