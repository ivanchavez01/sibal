@extends('layouts.app')

@section('content')
    <div class="container" ng-app="studentBrowser" ng-controller="browser">
        <div class="col-md-4">
            <form action="#" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="expediente">Expediente:</label>
                    <input type="text" ng-model="form.Noexpediente" name="expediente" id="expediente" class="form-control">
                </div>

                <div class="form-group">
                    <label for="usuarioSibal">Usuario sibal:</label>
                    <input type="text" ng-model="form.usuario_sibal" name="usuarioSibal" id="usuarioSibal" class="form-control">
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre (s):</label>
                    <input type="text" ng-model="form.nombre_alumno" name="nombre" id="nombre" class="form-control">
                </div>

                <div class="form-group">
                    <label for="appaterno">Apellido Paterno:</label>
                    <input type="text" ng-model="form.ap_paterno" name="app_aterno" id="appaterno" class="form-control">
                </div>

                <div class="form-group">
                    <label for="apmaterno">Apellido Materno:</label>
                    <input type="text" ng-model="form.ap_materno" name="ap_materno" id="apmaterno" class="form-control">
                </div>

                <div class="form-group">
                    <label for="separePerComa">
                        Usuarios sibal (separado por coma)
                    </label>
                    <textarea name="usersSibal" id="usersSibal" ng-model="form.usersSibal" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <button type="button" class="btn btn-default" ng-click="find()">
                        Buscar
                    </button>
                    <button type="button" class="btn btn-primary">
                        Agregar a lista (12)
                    </button>

                    <button type="button" class="btn btn-default" ng-click="printAll()">
                        <span class="glyphicon glyphicon-play"></span>
                    </button>
                </div>
            </form>
        </div>
        <div class="col-md-8">
            <h5>Listado de alumnos</h5>
            <input type="checkbox" name="selectAll" ng-click="selectAll()">
            
            <ul class="list-group">
                <li class="list-group-item" ng-repeat="student in students" 
                    ng-class="{'active': studentsSelected[student.ID_alumno]}">
                        <input type="checkbox" name="studentsSelected" ng-model="studentsSelected[student.ID_alumno]">
                        @{{ student.ID_alumno }} - @{{ student.nombre_alumno }} @{{student.ap_paterno}} @{{student.ap_materno}}
                </li>
            </ul>
        </div>
    </div>

    <script>
        var server = "{{url('/')}}";

        app = angular.module('studentBrowser', []);
        app.controller('browser', function($scope, Students){
            $scope.form = {};
            $scope.studentsSelected = {};
            
            $scope.selectAll = function() {
                angular.forEach($scope.students, function(student){
                    $scope.studentsSelected[student.ID_alumno] = true;
                });
            };

            $scope.find = function(){
                Students.find($scope.form).then(function(r){
                    $scope.students = r.data.students;
                });
            };
            
            $scope.printAll = function() {
                Students.certificated($scope.studentsSelected).then(function(){
                    //
                });
            };

            $scope.addStudent = function(alumnoId){
                //$scope.studentsSelected.push(alumnoId);
            };
        });

        app.factory('Students', function($http){
            return {
                find : function(params) {
                    return $http({
                        url     : server + '/students/json/get',
                        method  : 'POST',
                        data    : params
                    });
                }, 
                certificated: function(params) {
                    return $http({
                        url     : server + '/documentos/certificados',
                        method  : 'POST',
                        data    : { "students": params}
                    });
                }
            };
        });
    </script>
@stop