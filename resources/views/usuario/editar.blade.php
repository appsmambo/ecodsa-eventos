@extends('layouts.app')

@section('content')
<header>
    <div class="row mb-1">
        <div class="col s12">
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="medium material-icons">menu</i></a>
            <h4>Editar usuario</h4>
        </div>
    </div>
</header>
<main>
    <div class="row">
        <div class="col s12">
            <div class="card hoverable">
                <div class="card-content">
                    <form method="POST" action="{{ route('usuario.grabar') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $usuario['id'] }}">
                        <div class="row">
                            <div class="col s12">
                                <label>Rol</label>
                                <select name="rol" class="browser-default" required>
                                    <option value="" disabled selected>Seleccione</option>
                                    <option {{ $usuario['rol'] == '1' ? 'selected' : '' }} value="1">Administrador</option>
                                    <option {{ $usuario['rol'] == '3' ? 'selected' : '' }} value="3">Registro</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input name="name" type="text" maxlength="255" required value="{{ $usuario['name'] }}">
                                <label>Nombre</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input name="email" type="email" maxlength="255" required value="{{ $usuario['email'] }}">
                                <label>Email</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input name="password" type="password" maxlength="255" value="----------" disabled>
                                <label>Clave</label>
                            </div>
                        </div>
                        <button type="submit" class="waves-effect waves-light btn"><i class="material-icons left">save</i>GRABAR</button>
                        <a href="{{ route('usuario.index') }}" class="waves-effect waves-light btn-flat">CANCELAR</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
