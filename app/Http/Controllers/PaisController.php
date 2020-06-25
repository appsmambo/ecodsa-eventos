<?php

namespace App\Http\Controllers;
use App\Pais;
use App\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaisController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function postBuscarEstados(Request $request)
    {
        if ($request->isMethod('post')) {
            $pais = $request->input('pais', 42);  // x defecto México
            $estados = Estado::where('pais_id', $pais)
                        ->select('id', 'nombre')
                        ->orderBy('nombre')
                        ->get();
            return response()
                    ->json($estados->toArray());
        } else {
            return response()
                    ->json([]);
        }

    }
}
