@extends('layouts.app')

@section('content')
<header>
    <div class="row mb-1">
        <div class="col s12">
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="medium material-icons">menu</i></a>
            <h4>Asociaciones</h4>
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
                            <form method="POST" action="{{ route('asociacion.buscar') }}">
                                @csrf
                                <div class="row">
                                    <div class=" col s8">
                                        <input type="text" name="search" value="{{ $search }}" required autocomplete="search" autofocus>
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
                            <input type="text" value="{{ count($asociaciones) }} Registro(s)" disabled>
                        </div>
                        <div class="col s12 m3 right-align">
                            <a href="{{ route('asociacion.nuevo') }}" class="btn waves-effect waves-light">
                                <i class="material-icons left">add</i> Nuevo
                            </a>
                        </div>
                    </div>
                    <hr>
                    <table class="striped responsive-table">
                        <thead>
                          <tr>
                              <th>Nombre</th>
                              <th>Teléfonos</th>
                              <th>Correo</th>
                              <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        @forelse ($asociaciones as $row)
                            @php
                                $limite = 60
                            @endphp
                            <tr>
                                <td>
                                    <p class="truncate">
                                        {{ Str::of($row['nombre'])->substr(0, $limite) . (Str::length($row['nombre']) > $limite ? '...' : '') }}
                                    </p>
                                </td>
                                <td>{{ $row['telefonos'] }}</td>
                                <td>{{ $row['correo'] }}</td>
                                <td>
                                    <a href="{{ route('asociacion.editar', ['id' => $row['id']]) }}" class="btn-floating btn-small waves-effect waves-light">
                                        <i class="material-icons left">edit</i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
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
