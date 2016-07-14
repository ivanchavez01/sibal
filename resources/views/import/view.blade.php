@extends('layouts.app')
@section('content')
<!-- shim is needed to support non-HTML5 FormData browsers (IE8-9)-->
<script src="{{url('bower_components/ng-file-upload-shim/ng-file-upload-shim.min.js')}}"></script>
<script src="{{url('bower_components/ng-file-upload/ng-file-upload.min.js')}}"></script>

    <div class="container" ng-app="fileUpload" ng-controller="MyCtrl" ng-cloak>
        <div class="col-md-4">
            <form name="myForm">
                <fieldset>
                    <div class="main-header">
                        <h3>Seleccionar archivo comprimido</h3>
                        <span>Con los archivos necesarios para la importaci&oacute;n.</span>
                    </div>
                    <hr />
                    <br>

                    <input type="file" ngf-select ng-model="picFile" name="file" accept="application/zip" ngf-max-size="10MB" required ngf-model-invalid="errorFile">
                    <i ng-show="myForm.file.$error.required">*required</i><br>
                    <br />

                    <button class="btn btn-default" ng-disabled="!myForm.$valid" ng-click="uploadPic(picFile)">
                        Subir archivo
                    </button>
                    <br />
                    <br />
                    
                    <div class="alerts" ng-show="nosubmit">
                        <span class="progress" ng-show="picFile.progress >= 0">
                            <div class="progress-bar progress-bar-success progress-bar-striped active" style="width:{#picFile.progress#}%" ng-bind="picFile.progress + '%'">
                                <span class="sr-only">60% Complete</span>
                            </div>
                        </span>

                        <span ng-show="picFile.result" class="label label-success">El archivo se subio correctamente!</span>
                        <span class="err" ng-show="errorMsg">{# errorMsg #}</span>
                    </div>
                    <div class="alerts" ng-show="unzip">
                        <span class="label label-info">
                            Descomprimiendo archivo...
                        </span>
                    </div>
                </fieldset>
                <br>
            </form>
        </div>
    </div>



<script>
    var app = angular.module('fileUpload', ['ngFileUpload']);
    
    app.config(function($interpolateProvider){
        $interpolateProvider.startSymbol("{#");
        $interpolateProvider.endSymbol("#}");
    });

    app.factory('Unziper', function($http){
        return {
            run: function(filename) {
                return $http({
                    url: '{{url("import/unzip")}}',
                    method: 'GET',
                    params: {
                        'filename': filename
                    }
                })
            }
        };
    });

    app.controller('MyCtrl', function ($scope, Upload, $timeout, Unziper) {
        $scope.nosubmit = true;
        $scope.unzip    = false;
        
        $scope.uploadPic = function(file) {
            file.upload = Upload.upload({
                url: '{{url("import/upload")}}',
                data: { file: file},
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    file.result = response.data;

                    $timeout(function(){
                        $scope.nosubmit = false;
                        $scope.unzip    = true;

                        Unziper.run(file.result["filename"]).then(function(r){
                            location.href = "{{url('import/upload/list')}}?dir=" + r.data.dir; 
                        });
                    }, 2000);
                });

            }, function (response) {
            if (response.status > 0)
                $scope.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
                // Math.min is to fix IE which reports 200% sometimes
                file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
            });
        }
    });
</script>
@stop