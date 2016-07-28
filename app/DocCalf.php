<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class DocCalf extends Model
{
    protected $table = 'doccalf';
    protected $primaryKey = 'user_sibal';

    public function scopeOnlyMatters($query) {
        return $query->join('materias', 'materias.clave_materia', '=', 'doccalf.matters_id')
            ->groupBy('matters_id');
    }
}
