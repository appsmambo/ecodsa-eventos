<?php

namespace App\Http\Controllers;
use App\Asociacion;
use Illuminate\Http\Request;

class AsociacionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $search = '';
        $asociaciones = Asociacion::select('id', 'nombre', 'razon_social', 'telefonos', 'correo')->get();
        return view('asociacion.index')
                    ->with('asociaciones', $asociaciones->toArray())
                    ->with('search', $search);
    }

    public function postSearch(Request $request)
    {
        if ($request->isMethod('post')) {
            $search = $request->input('search');
            $asociaciones = Asociacion::select('id', 'nombre', 'telefonos', 'correo')
                        ->where('nombre', 'like', "%$search%")
                        ->get();
            return view('asociacion.index')
                    ->with('asociaciones', $asociaciones->toArray())
                    ->with('search', $search);
        } else {
            return redirect()->route('asociacion.index');
        }
    }

    public function getNuevo()
    {
        return view('asociacion.nuevo');
    }

    public function getEditar($id)
    {
        $asociacion = Asociacion::find($id);
        return view('asociacion.editar')->with('asociacion', $asociacion->toArray());
    }

    public function postGrabar(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $request->input('id', 0);
            $rfc = $request->input('rfc');
            $nombre = $request->input('nombre');
            $razon_social = $request->input('razon_social');
            $direccion = $request->input('direccion');
            $direccion_fiscal = $request->input('direccion_fiscal');
            $telefonos = $request->input('telefonos');
            $correo = $request->input('correo');
            if ($id !== 0) {
                $asociacion = Asociacion::find($id);
            } else {
                $asociacion = new Asociacion;
            }
            $asociacion->rfc = $rfc;
            $asociacion->nombre = $nombre;
            $asociacion->razon_social = $razon_social;
            $asociacion->direccion = $direccion;
            $asociacion->direccion_fiscal = $direccion_fiscal;
            $asociacion->telefonos = $telefonos;
            $asociacion->correo = $correo;
            $asociacion->save();
        }
        return redirect()->route('asociacion.index');
    }
}
