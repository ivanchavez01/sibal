@extends('layouts.app')

@section('content')

<style type="text/css">
    .boxes {
        height: 60px;
        background: #CCC;
        border: 1px solid #ddd;
        text-align: center;
    }    
</style>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="col-md-3 boxes">
                       <a href="{{url('import/excel')}}">Importaci&oacute;n</a>
                    </div>


                    <div class="col-md-3 boxes">
                       <a href="{{url('students/browser')}}">Buscar alumnos</a>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>
@endsection
