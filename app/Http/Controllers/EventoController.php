<?php

namespace App\Http\Controllers;
use App\Actividad;
use App\Asociacion;
use App\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $search = '';
        $eventos = Evento::select('id', 'nombre', 'sede', 'ciudad', 'fecha_inicial', 'fecha_final', 'responsable')
                    ->orderBy('id', 'DESC')
                    ->get();
        return view('evento.index')
                    ->with('eventos', $eventos->toArray())
                    ->with('search', $search);
    }

    public function postSearch(Request $request)
    {
        if ($request->isMethod('post')) {
            $search = $request->input('search');
            $eventos = Evento::select('id', 'nombre', 'sede', 'ciudad', 'fecha_inicial', 'fecha_final', 'responsable')
                        ->where('nombre', 'like', "%$search%")
                        ->orWhere('sede', 'like', "%$search%")
                        ->orWhere('ciudad', 'like', "%$search%")
                        ->orWhere('responsable', 'like', "%$search%")
                        ->get();
            return view('evento.index')
                    ->with('eventos', $eventos->toArray())
                    ->with('search', $search);
        } else {
            return redirect()->route('evento.index');
        }
    }

    public function getNuevo()
    {
        $asociaciones = Asociacion::select('id', 'nombre')->get();
        return view('evento.nuevo')
                ->with('asociaciones', $asociaciones->toArray());
    }

    public function getEditar($id)
    {
        $actividades = Actividad::select('id', 'nombre', 'descripcion')->where('evento_id', $id)->get();
        $arrActividades = $actividades->toArray();
        $texto = '[';
        foreach($arrActividades as $actividad) {
            $nombre = $actividad['nombre'];
            $descripcion = $actividad['descripcion'];
            $texto .= '{"nombre": "'.$nombre.'", "descripcion": "'.$descripcion.'"},';
        }
        $texto = trim($texto, ',') . ']';
        $asociaciones = Asociacion::select('id', 'nombre')->get();
        $evento = Evento::find($id);
        return view('evento.editar')
                ->with('actividades', $texto)
                ->with('asociaciones', $asociaciones->toArray())
                ->with('evento', $evento->toArray());
    }

    public function postGrabar(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $request->input('id', 0);
            $asociacion_id = $request->input('asociacion_id');
            $categoria = $request->input('categoria');
            $estatus = $request->input('estatus');
            $nombre = $request->input('nombre');
            $descripcion = $request->input('descripcion');
            $ciudad = $request->input('ciudad');
            $sede = $request->input('sede');
            $fecha_inicial = $request->input('fecha_inicial');
            $fecha_final = $request->input('fecha_final');
            $tarifa = $request->input('tarifa', 0);
            $nomenclatura = $request->input('nomenclatura');
            $responsable = $request->input('responsable');
            $responsable_email = $request->input('responsable_email');
            $url_formulario_inscripcion = $request->input('url_formulario_inscripcion');
            $url_formulario_reservacion = $request->input('url_formulario_reservacion');
            $url_programa = $request->input('url_programa');
            $url_programa_externo = $request->input('url_programa_externo');
            $numero_inscripciones = $request->input('numero_inscripciones');
            $numero_asistentes = $request->input('numero_asistentes');
            $resena = $request->input('resena');
            $logo = null;
            if ($request->hasFile('imagen')) {
                if ($request->file('imagen')->isValid()) {
                    $logo = $request->imagen->store('images');
                }
            }

            if ($id !== 0) {
                $evento = Evento::find($id);
            } else {
                $evento = new Evento;
            }
            $evento->asociacion_id = $asociacion_id;
            $evento->nombre = $nombre;
            $evento->categoria = $categoria;
            $evento->estatus = $estatus;
            $evento->descripcion = $descripcion;
            $evento->ciudad = $ciudad;
            $evento->sede = $sede;
            $evento->fecha_inicial = $fecha_inicial;
            $evento->fecha_final = $fecha_final;
            $evento->tarifa = $tarifa;
            $evento->nomenclatura = $nomenclatura;
            $evento->responsable = $responsable;
            $evento->responsable_email = $responsable_email;
            $evento->url_formulario_inscripcion = $url_formulario_inscripcion;
            $evento->url_formulario_reservacion = $url_formulario_reservacion;
            $evento->url_programa = $url_programa;
            $evento->url_programa_externo = $url_programa_externo;
            $evento->numero_inscripciones = $numero_inscripciones;
            $evento->numero_asistentes = $numero_asistentes;
            $evento->resena = $resena;
            if ($logo !== null) $evento->imagen = $logo;
            $evento->save();
            $id = $evento->id;

            $actividades = $request->input('actividades', '');
            if (strlen($actividades) > 0) {
                Actividad::where('evento_id', $id)->delete();
                $arrActividades = json_decode($actividades);
                foreach($arrActividades as $row) {
                    $actividad = new Actividad;
                    $actividad->evento_id = $id;
                    $actividad->nombre = $row->nombre;
                    $actividad->descripcion = $row->descripcion;
                    $actividad->save();
                }
            }
        }
        return redirect()->route('evento.index');
    }
}
