@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-group">
                  <?php foreach($fileTypes as $fileType): ?>
                        <li class="list-group-item">
                            <?php echo $fileType["name"]; ?>


                            <select name="type_file[$fileType["id"]]">
                                <?php foreach($files as $file): ?>
                                    <option value="<?php echo $file; ?>"><?php echo $file; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </li>
                    <?php endforeach; ?>
                </ul>


                <button class="btn btn-default">
                    Procesar
                </button>
            </div>
        </div>
    </div>
@stop