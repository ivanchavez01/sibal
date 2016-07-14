@extends('layouts.app')

@section('content')
    
<div class="container" ng-app="proccessFiles" ng-controller="Files" ng-cloak>
    <form action="{{url('import/upload/process')}}" method="post" name="myForm">
        <div class="row">
            <div class="col-lg-12">
                <?php $dir = $req->input("dir"); ?>
                <input type="hidden" name="dir" ng-model="dir" ng-init="dir = '{{$dir}}'">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="col-md-3">
                            Archivo 911
                        </div>
                        <div class="col-md-9">
                            <select name="doc911" class="form-control" ng-model="doc911" required="required">
                                <?php foreach($files as $file): ?>
                                    <?php $file = str_replace(array("tmp/", $req->input("dir")."/"), array("", ""), $file); ?>
                                    <option value="<?php echo $file; ?>"><?php echo $file; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </li>

                    <li class="list-group-item">
                        <div class="col-md-3">
                            Archivo Calificaciones
                        </div>
                        <div class="col-md-9">
                            <select name="doccalf" class="form-control" ng-model="doccalf" required="required">
                                <?php foreach($files as $file): ?>
                                    <?php $file = str_replace(array("tmp/", $req->input("dir")."/"), array("", ""), $file); ?>
                                    <option value="<?php echo $file; ?>"><?php echo $file; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </li>

                    <li class="list-group-item">
                        <div class="col-md-3">
                            Imagenes
                        </div>
                        <div class="col-md-9">
                            <select name="photos" class="form-control" ng-model="photos" required="required">
                                <option value="Fotos">/Fotos</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                </ul>

                <div class="alerts" ng-show="Showstatus">
                    <span class="label label-info">{# status #}</span>
                </div>

                <button type="button" class="btn btn-default" ng-click="processing()" ng-disabled="!myForm.$valid || doc911 == doccalf">
                    Procesar
                </button>
            </div>
        </div>
    </form>
</div>
    

<script>
    app = angular.module('proccessFiles', []);

    app.config(function($interpolateProvider){
        $interpolateProvider.startSymbol("{#");
        $interpolateProvider.endSymbol("#}");
    });
    
    app.factory('Process', function($http){
        return {
            saveExcel: function(objFiles) {
                return $http({
                    url: "{{url('import/upload/process')}}",
                    method: 'GET',
                    params: {
                        f911    : objFiles.f911,
                        fcalif  : objFiles.f911,
                        dir     : objFiles.dir
                    }
                });
            },
            copyPhotos: function(){
                 return $http({
                    url: "{{url('import/upload/movePhotos')}}",
                    method: 'GET',
                    params: {
                        fphotos : objFiles.fphotos,
                        dir     : objFiles.dir
                    }
                });
            }
        };
    });

    app.controller('Files', function($scope, Process){
        $scope.status       = "";
        $scope.Showstatus   = false;
        
        $scope.processing = function(){
            $scope.Showstatus = true;
            $scope.status = "Procesando libros de excel.";

            objFiles = {
                f911    : $scope.doc911,
                fcalif  : $scope.doccalf,
                fphotos : $scope.photos,
                dir     : $scope.dir
            };

            Process.saveExcel(objFiles).then(function(){
                $scope.Showstatus = true;
                $scope.status = "Copiando fotos.";

                Process.copyPhotos(objFiles).then(function(){
                    $scope.Showstatus = true;
                    $scope.status = "Se guardo la informacion correctamente.";
                });
            });
        };
    });

   
</script>
@stop