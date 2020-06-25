<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $search = '';
        $usuarios = User::select('id', 'name', 'rol', 'email')->get();
        return view('usuario.index')
                    ->with('usuarios', $usuarios->toArray())
                    ->with('search', $search);
    }

    public function postSearch(Request $request)
    {
        if ($request->isMethod('post')) {
            $search = $request->input('search');
            $usuarios = User::select('id', 'name', 'rol', 'email')
                        ->where('nombre', 'like', "%$search%")
                        ->get();
            return view('usuario.index')
                    ->with('usuarios', $usuarios->toArray())
                    ->with('search', $search);
        } else {
            return redirect()->route('usuario.index');
        }
    }

    public function getNuevo()
    {
        return view('usuario.nuevo');
    }

    public function getEditar($id)
    {
        $usuario = User::find($id);
        return view('usuario.editar')->with('usuario', $usuario->toArray());
    }

    public function postGrabar(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $request->input('id', 0);
            $rol = $request->input('rol');
            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password', '');
            if ($id !== 0) {
                $usuario = User::find($id);
            } else {
                $usuario = new User();
            }
            $usuario->rol = $rol;
            $usuario->name = $name;
            $usuario->email = $email;
            if ($password != '') $usuario->password = Hash::make($password);
            $usuario->save();
        }
        return redirect()->route('usuario.index');
    }
}
