<?php

namespace App\Http\Controllers;
use App\Participante;
use App\Asociacion;
use App\Pais;
use App\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParticipanteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $search = '';
        $participantes = Participante::select('id', DB::raw("CONCAT(participante.titulo, ' ', participante.nombre, ' ', participante.apellido_paterno, ' ', participante.apellido_materno) AS participante"), 'telefono_casa', 'telefono_movil', 'email', DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y') AS fecha_alta"))
                        ->addSelect(['pais_nombre' => Pais::select('nombre')->whereColumn('id', 'participante.pais_id')])
                        ->addSelect(['estado_nombre' => Estado::select('nombre')->whereColumn('id', 'participante.estado_id')])
                        ->get();
        return view('participante.index')
                    ->with('participantes', $participantes->toArray())
                    ->with('search', $search);
    }

    public function postSearch(Request $request)
    {
        if ($request->isMethod('post')) {
            $search = $request->input('search');
            $participantes = Participante::select('id', DB::raw("CONCAT(titulo, ' ', nombre, ' ', apellido_paterno, ' ', apellido_materno) AS participante"), 'telefono_casa', 'telefono_movil', 'email', DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y') AS fecha_alta"))
                                ->addSelect(['pais_nombre' => Pais::select('nombre')->whereColumn('id', 'participante.pais_id')])
                                ->addSelect(['estado_nombre' => Estado::select('nombre')->whereColumn('id', 'participante.estado_id')])
                                ->where('nombre', 'like', "%$search%")
                                ->orWhere('apellido_paterno', 'like', "%$search%")
                                ->orWhere('apellido_materno', 'like', "%$search%")
                                ->get();
            return view('participante.index')
                    ->with('participantes', $participantes->toArray())
                    ->with('search', $search);
        } else {
            return redirect()->route('asociacion.index');
        }
    }

    public function getNuevo()
    {
        $paises = Pais::select('id', 'nombre')->orderBy('nombre')->get();
        $asociaciones = Asociacion::select('id', 'nombre')->get();
        return view('participante.nuevo')
                ->with('asociaciones', $asociaciones->toArray())
                ->with('paises', $paises->toArray());
    }

    public function getEditar($id)
    {
        $paises = Pais::select('id', 'nombre')->orderBy('nombre')->get();
        $asociaciones = Asociacion::select('id', 'nombre')->get();
        $participante = Participante::find($id);
        return view('participante.editar')
                ->with('asociaciones', $asociaciones->toArray())
                ->with('paises', $paises->toArray())
                ->with('participante', $participante->toArray());
    }

    public function postGrabar(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $request->input('id', 0);
            $titulo = $request->input('titulo');
            $nombre = $request->input('nombre');
            $apellido_paterno = $request->input('apellido_paterno');
            $apellido_materno = $request->input('apellido_materno');
            $telefono_casa = $request->input('telefono_casa');
            $telefono_movil = $request->input('telefono_movil');
            $email = $request->input('email');
            $asociacion_id = $request->input('asociacion_id');
            $lugar_trabajo = $request->input('lugar_trabajo');
            $ocupacion = $request->input('ocupacion');
            $sexo = $request->input('sexo');
            $edad = $request->input('edad');
            $fecha_nacimiento = $request->input('fecha_nacimiento');
            $pais_id = $request->input('pais_id');
            $estado_id = $request->input('estado_id');
            if ($id !== 0) {
                $participante = Participante::find($id);
            } else {
                $participante = new Participante();
            }
            $participante->titulo = $titulo;
            $participante->nombre = $nombre;
            $participante->apellido_paterno = $apellido_paterno;
            $participante->apellido_materno = $apellido_materno;
            $participante->telefono_casa = $telefono_casa;
            $participante->telefono_movil = $telefono_movil;
            $participante->email = $email;
            $participante->asociacion_id = $asociacion_id;
            $participante->lugar_trabajo = $lugar_trabajo;
            $participante->ocupacion = $ocupacion;
            $participante->sexo = $sexo;
            $participante->edad = $edad;
            $participante->fecha_nacimiento = $fecha_nacimiento;
            $participante->pais_id = $pais_id;
            $participante->estado_id = $estado_id;
            $participante->save();
        }
        return redirect()->route('participante.index');
    }
}
