@extends('layouts.app')

@section('content')
<script type="text/javascript" src="{{url('/bower_components/moment/min/moment.min.js')}}"></script>
<script type="text/javascript" src="{{url('/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
<link rel="stylesheet" href="{{url('/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" />

    <div class="container" ng-app="configActas" ng-controller="actasSteps">
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

             <div>
                <button class="btn btn-primary pull-right" ng-click="next()">
                    <span ng-if="step == 1">Siguiente ></span>
                    <span ng-if="step == 2">Guardar</span>
                </button>
            </div>
            <div class="clearfix"></div>
        </div>


        <div class="row step1" ng-show="step == 1">
            {{ csrf_field() }}
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

                <form name="configActas">
                    <br>
                    <br>
                    <br>
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
                                @if($ciclos->count() > 0)
                                    @foreach($ciclos->get() as $ciclo)
                                        <option value="{{$ciclo->ID_Ciclo}}">{{$ciclo->nombre_ciclo}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-add-ciclo" type="button">{{trans('buttons.add_ciclo')}}</button>
                            </span>
                        </div>
                    </div>
                </form>


                <div class="alert alert-warning">
                    Nota: Los registros aun no est&aacute;n han sido salvados, se encuentran de manera temporal. 
                </div>
            </div>
        </div>
        <!-- step1 -->


        <div class="row step2" ng-show="step == 2">
            <table class="table">
                <thead>
                    <th>Materia</th>
                    <th>Maestro</th>
                </thead>
                <tbody>
                @foreach($matters as $matter)
                    <tr>
                        <td>{{$matter->nombre_materia}}</td>
                        <td>
                            @if($teachers->count() > 0)
                            <select name="sl_maestros[{{$matter->ID_Materia}}]" data-id="{{$matter->ID_Materia}}" class="form-control materias">
                                @foreach($teachers as $teacher)
                                    
                                    {{--*/ 
                                        $selected = " selected='selected'";
                                        
                                        if($matter->ID_Empleado_Default != $teacher->ID_Empleado)
                                            $selected = "";
                                    /*--}}
                                    <option value="{{$teacher->ID_Empleado}}" {{$selected}}>{{$teacher->nombre_empleado}}</option>
                                @endforeach
                            </select>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

<div class="modal fade modal-add-ciclo" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Agregar nuevo ciclo</h4>
        </div>
        <div class="modal-body">
            <form action="#" name="formCiclo">
                <div class="form-group">
                    <label for="dp_ciclo">Ciclo</label>
                    
                    <div class="input-group datepicker">
                        <input type="text" class="form-control" data-date-format="YYYY-MM">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary">Guardar</button>
        </div>
    </div>
  </div>
</div>

<script src='{{url("bower_components/socket.io-client/socket.io.js")}}'></script>
<script>
var socket = io.connect("http://localhost:3000");

socket.on('message', function(){
    alert("hay un nuevo mensaje");
});

$(document).ready(function(){
    $(".datepicker").datetimepicker();
    $(".btn-add-ciclo").click(function(){
        $(".modal-add-ciclo").modal("show");
    });
});
</script>

<script>
    app = angular.module('configActas', [])
    app.config(function($interpolateProvider){
        $interpolateProvider.startSymbol("{#");
        $interpolateProvider.endSymbol("#}");
    });

    app.controller('actasSteps', function($scope, $http){
        $scope.step = 1;

        $scope.next = function() {
            if($scope.step < 2){
                $scope.step++;
            }else{
                save();
            }
        }

        function save(){
            var matters = [];

            $("select.materias").each(function(){
                matter = {
                    metter_id: $(this).attr("data-id"),
                    teacher_id: $(this).val()
                };
                matters.push(matter);
            });

             $http({
                method: 'post',
                url: "{{url('manager/process')}}",
                data:{
                    plan_id : $("#sl_planEstudio").val(),
                    lot_id  : 4,
                    ciclo_id: $("#sl_ciclo").val(),
                    metters : matters,
                    _token  : $("input[name=_token]").val()
                }
             });
        }
    });
</script>
@stop