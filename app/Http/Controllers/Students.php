<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Students extends Controller
{
    public function browser() {
    	return view('modules.students.browser');
    }

    public function json(Request $req) {
        if($req->input("usersSibal") != "") {
            $usersSibal = explode("\n", $req->input("usersSibal"));
            
            $alumnos = \App\alumnos::whereIn('usuario_sibal', $usersSibal);
        } else {
            $alumnos = \App\alumnos::OrWhere($req->all());
        }
        return response()->json(['status' => 'success', 'students' => $alumnos->get()]);
    }
}
