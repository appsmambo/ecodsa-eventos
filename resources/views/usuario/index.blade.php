@extends('layouts.app')

@section('content')
<header>
    <div class="row mb-1">
        <div class="col s12">
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="medium material-icons">menu</i></a>
            <h4>Usuarios</h4>
        </div>
    </div>
</header>
<main>
    <div class="row">
        <div class="col s12">
            <div class="card hoverable">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12 m6">
                            <form method="POST" action="{{ route('usuario.buscar') }}">
                                @csrf
                                <div class="row">
                                    <div class=" col s8">
                                        <input id="search" type="text" name="search" value="{{ $search }}" required autocomplete="search" autofocus>
                                    </div>
                                    <div class="col s4">
                                        <button class="btn-floating waves-effect waves-light" type="submit" name="action">
                                            <i class="material-icons right">search</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col m3 right-align hide-on-med-and-down">
                            <input type="text" value="{{ count($usuarios) }} Registro(s)" disabled>
                        </div>
                        <div class="col s12 m3 right-align">
                            <a href="{{ route('usuario.nuevo') }}" class="btn waves-effect waves-light">
                                <i class="material-icons left">add</i> Nuevo
                            </a>
                        </div>
                    </div>
                    <hr>
                    <table class="striped responsive-table">
                        <thead>
                          <tr>
                              <th>Rol</th>
                              <th>Nombre</th>
                              <th>Correo</th>
                              <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        @forelse ($usuarios as $row)
                            <tr>
                                <td>{{ $row['rol'] == 1 ? 'Administrador' : 'Registro' }}</td>
                                <td>{{ $row['name'] }}</td>
                                <td>{{ $row['email'] }}</td>
                                <td>
                                    <a href="{{ route('usuario.editar', ['id' => $row['id']]) }}" class="btn-floating btn-small waves-effect waves-light">
                                        <i class="material-icons left">edit</i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    No se encontraron registros.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
