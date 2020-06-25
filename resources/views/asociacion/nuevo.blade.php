@extends('layouts.app')

@section('content')
<header>
    <div class="row mb-1">
        <div class="col s12">
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="medium material-icons">menu</i></a>
            <h4>Nueva asociación</h4>
        </div>
    </div>
</header>
<main>
    <div class="row">
        <div class="col s12">
            <div class="card hoverable">
                <div class="card-content">
                    <form method="POST" action="{{ route('asociacion.grabar') }}">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input name="rfc" type="text" maxlength="13">
                                <label>Rfc</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input name="nombre" type="text" maxlength="200" required>
                                <label>Nombre</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input name="razon_social" type="text" maxlength="200">
                                <label>Razon social</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input name="direccion" type="text" maxlength="200">
                                <label>Dirección</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input name="direccion_fiscal" type="text" maxlength="200">
                                <label>Dirección fiscal</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input name="telefonos" type="text" maxlength="200">
                                <label>Teléfonos</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input name="correo" type="email" maxlength="200">
                                <label>Email</label>
                            </div>
                        </div>
                        <button type="submit" class="waves-effect waves-light btn"><i class="material-icons left">save</i>GRABAR</button>
                        <a href="{{ route('asociacion.index') }}" class="waves-effect waves-light btn-flat">CANCELAR</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
