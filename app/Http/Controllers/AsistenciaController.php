<?php

namespace App\Http\Controllers;

use App\Asistencia;
use App\Evento;
use App\Participante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsistenciaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $eventos = Evento::select('id', 'nombre')
                    ->where('estatus', 1)
                    ->get();
        return view('asistencia.index')
                    ->with('evento', 0)
                    ->with('eventos', $eventos->toArray())
                    ->with('participantes', [])
                    ->with('noParticipantes', []);
    }

    public function postSearch(Request $request)
    {
        if ($request->isMethod('post')) {
            $eventos = Evento::select('id', 'nombre')
                        ->where('estatus', 1)
                        ->get();
            $evento = $request->input('evento');
            $nombre = $request->input('nombre');
            $apellido_paterno = $request->input('apellido_paterno');
            $apellido_materno = $request->input('apellido_materno');

            $participantes = Participante::select('id', DB::raw("CONCAT(titulo, ' ', nombre, ' ', apellido_paterno, ' ', apellido_materno) AS participante"), 'telefono_casa', 'telefono_movil', 'email')
                                ->whereIn('id', function($query) use ($evento) {
                                    $query->select('participante_id')
                                            ->from('asistencia')
                                            ->where('evento_id', $evento);
                                })->get();

            $noParticipantes = Participante::select('id', DB::raw("CONCAT(titulo, ' ', nombre, ' ', apellido_paterno, ' ', apellido_materno) AS participante"), 'telefono_casa', 'telefono_movil', 'email')
                                ->whereNotIn('id', function($query) use ($evento) {
                                    $query->select('participante_id')
                                            ->from('asistencia')
                                            ->where('evento_id', $evento);
                                })->get();

            return view('asistencia.index')
                    ->with('evento', $evento)
                    ->with('eventos', $eventos->toArray())
                    ->with('participantes', $participantes->toArray())
                    ->with('noParticipantes', $noParticipantes->toArray());
        } else {
            return redirect()->route('asistencia.index');
        }
    }

    public function postGrabar(Request $request)
    {
        $evento = $request->input('evento', 0);
        $participa = $request->input('participa', 1);
        if ($request->isMethod('post')) {
            $participante = $request->input('participante', []);
            if ($evento !== 0 && count($participante) > 0) {
                foreach($participante as $id) {
                    if ($participa == 1) {
                        $asistencia = new Asistencia;
                        $asistencia->evento_id = $evento;
                        $asistencia->participante_id = $id;
                        $asistencia->save();
                    } else {
                        Asistencia::where('evento_id', $evento)
                                    ->where('participante_id', $id)
                                    ->delete();
                    }
                }
            }
        }
        return redirect()->route('asistencia.buscar');
    }

}
