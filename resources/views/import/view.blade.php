@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="import/upload/file">
            Seleccionar su archivo
            <input type="file" name="filezip">

            <button class="btn btn-default">
                Subir archivo
            </button>
        </form>
    </div>
@stop