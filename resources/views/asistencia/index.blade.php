@extends('layouts.app')

@section('content')
<header>
    <div class="row mb-1">
        <div class="col s12">
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="medium material-icons">menu</i></a>
            <h4>Asistencia</h4>
        </div>
    </div>
</header>
<main>
    <div class="row">
        <div class="col s12">
            <div class="card hoverable">
                <div class="card-content">
                    <form method="POST" action="{{ route('asistencia.buscar') }}">
                        @csrf
                        <div class="row mb-0">
                            <div class="col s12 m6">
                                <label>Evento</label>
                                <select name="evento" class="browser-default" required>
                                    <option value="" disabled selected>Seleccione</option>
                                    @foreach ($eventos as $row)
                                    <option value="{{ $row['id'] }}">{{ $row['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col s12 m5 l6" style="display: none">
                                <div class="row mb-0">
                                    <div class="input-field col m4">
                                        <input name="nombre" type="text" class="validate" maxlength="50">
                                        <label>Nombre</label>
                                    </div>
                                    <div class="input-field col m4">
                                        <input name="apellido_paterno" type="text" class="validate" maxlength="50">
                                        <label>Apellido paterno</label>
                                    </div>
                                    <div class="input-field col m4">
                                        <input name="apellido_materno" type="text" class="validate" maxlength="50">
                                        <label>Apellido materno</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m3 l2 right-align">
                                <button class="btn-floating waves-effect waves-light mt-3" type="submit" name="action">
                                    <i class="material-icons right">search</i>
                                </button>
                                <a href="{{ route('asistencia.index') }}" class="btn-floating waves-effect waves-light mt-3 red" type="submit" name="action">
                                    <i class="material-icons right">refresh</i>
                                </a>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs">
                                <li class="tab col s3"><a class="active" href="#test1">No aprobados</a></li>
                                <li class="tab col s3"><a href="#test2">Aprobados</a></li>
                            </ul>
                        </div>
                        <div id="test1" class="col s12">
                            <form action="{{ route('asistencia.grabar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="evento" value="{{ $evento }}">
                                <input type="hidden" name="participa" value="1">
                                @if (count($noParticipantes) >= 1)
                                <p class="my-3">
                                  <label>
                                    <input id="marcarTodos" type="checkbox" onclick="marcarNoParticipantes()" />
                                    <span>Marcar todos</span>
                                  </label>
                                  &nbsp;&nbsp;&nbsp;
                                  <button class="btn btn-small waves-effect waves-light" type="submit" name="action">Participar
                                    <i class="material-icons right">check</i>
                                  </button>
                                </p>
                                @endif
                                <table class="striped responsive-table">
                                    <thead>
                                    <tr>
                                        <th>Participante</th>
                                        <th>Teléfonos</th>
                                        <th>Correo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($noParticipantes as $row)
                                        <tr>
                                            <td>
                                                <label>
                                                    <input name="participante[]" value="{{ $row['id'] }}" type="checkbox" class="noParticipantes" />
                                                    <span>{{ $row['participante'] }}</span>
                                                </label>
                                            </td>
                                            <td>{{ $row['telefono_casa'] }} <br> {{ $row['telefono_movil'] }}</td>
                                            <td>{{ $row['email'] }}</td>
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
                            </form>
                        </div>
                        <div id="test2" class="col s12">
                            <form action="{{ route('asistencia.grabar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="evento" value="{{ $evento }}">
                                <input type="hidden" name="participa" value="0">
                                @if (count($participantes) >= 1)
                                <p class="my-3">
                                  <label>
                                    <input id="marcarTodos" type="checkbox" onclick="marcarParticipantes()" />
                                    <span>Marcar todos</span>
                                  </label>
                                  &nbsp;&nbsp;&nbsp;
                                  <button class="btn btn-small waves-effect waves-light" type="submit" name="action">No participar
                                    <i class="material-icons right">check</i>
                                  </button>
                                </p>
                                @endif
                                <table class="striped responsive-table">
                                    <thead>
                                    <tr>
                                        <th>Participante</th>
                                        <th>Teléfonos</th>
                                        <th>Correo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($participantes as $row)
                                        <tr>
                                            <td>
                                                <label>
                                                    <input name="participante[]" value="{{ $row['id'] }}" type="checkbox" class="participantes" />
                                                    <span>{{ $row['participante'] }}</span>
                                                </label>
                                            </td>
                                            <td>{{ $row['telefono_casa'] }} <br> {{ $row['telefono_movil'] }}</td>
                                            <td>{{ $row['email'] }}</td>
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
    function marcarNoParticipantes() {
        var el = document.getElementsByClassName("noParticipantes");
        for (var i=0;i<el.length; i++) {
            el[i].click();
        }
    }
    function marcarParticipantes() {
        var el = document.getElementsByClassName("participantes");
        for (var i=0;i<el.length; i++) {
            el[i].click();
        }
    }
</script>
@endsection
