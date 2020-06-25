@extends('layouts.app')

@section('content')
<header>
    <div class="row mb-1">
        <div class="col s12">
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="medium material-icons">menu</i></a>
            <h4>Editar participante</h4>
        </div>
    </div>
</header>
<main>
    <div class="row">
        <div class="col s12">
            <div class="card hoverable">
                <div class="card-content">
                    <form method="POST" action="{{ route('participante.grabar') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $participante['id'] }}">
                        <input type="hidden" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ $participante['fecha_nacimiento'] }}">
                        <div class="row">
                            <div class="input-field col s12 m4">
                                <input name="titulo" type="text" maxlength="20" value="{{ $participante['titulo'] }}">
                                <label>Título</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m4">
                                <input name="nombre" type="text" maxlength="50" required value="{{ $participante['nombre'] }}">
                                <label>Nombre *</label>
                            </div>
                            <div class="input-field col s12 m4">
                                <input name="apellido_paterno" type="text" maxlength="50" required value="{{ $participante['apellido_paterno'] }}">
                                <label>Apellido paterno *</label>
                            </div>
                            <div class="input-field col s12 m4">
                                <input name="apellido_materno" type="text" maxlength="50" required value="{{ $participante['apellido_materno'] }}">
                                <label>Apellido materno *</label>
                            </div>
                            <!-- -->
                            <div class="input-field col s12 m4">
                                <input name="telefono_casa" type="tel" maxlength="50" required value="{{ $participante['telefono_casa'] }}">
                                <label>Teléfono *</label>
                            </div>
                            <div class="input-field col s12 m4">
                                <input name="telefono_movil" type="tel" maxlength="50" required value="{{ $participante['telefono_movil'] }}">
                                <label>Teléfono movil *</label>
                            </div>
                            <div class="input-field col s12 m4">
                                <input name="email" type="email" maxlength="200" required value="{{ $participante['email'] }}">
                                <label>Email *</label>
                            </div>
                            <!-- -->
                            <div class="input-field col s12 m4">
                                <select name="asociacion_id">
                                    <option value="" disabled selected>Seleccione</option>
                                    @foreach ($asociaciones as $row)
                                    <option {{ $row['id'] == $participante['asociacion_id'] ? 'selected' : '' }} value="{{ $row['id'] }}">{{ $row['nombre'] }}</option>
                                    @endforeach
                                </select>
                                <label>Asociación</label>
                            </div>
                            <div class="input-field col s12 m4">
                                <input name="lugar_trabajo" type="text" maxlength="200" value="{{ $participante['lugar_trabajo'] }}">
                                <label>Lugar trabajo</label>
                            </div>
                            <div class="input-field col s12 m4">
                                <input name="ocupacion" type="text" maxlength="200" value="{{ $participante['ocupacion'] }}">
                                <label>Ocupación</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s6">
                                        <label>
                                            <input name="sexo" type="radio" value="H" {{ $participante['sexo'] == 'H' ? 'checked' : ''}}>
                                            <span>Hombre</span>
                                        </label>
                                    </div>
                                    <div class="col s6">
                                        <label>
                                            <input name="sexo" type="radio" value="M" {{ $participante['sexo'] == 'M' ? 'checked' : ''}}>
                                            <span>Mujer</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="input-field col s12 m4">
                                <input name="edad" type="number" maxlength="2" value="{{ $participante['edad'] }}">
                                <label>Edad</label>
                            </div>
                            <div class="input-field col s12 m4">
                                <input type="text" class="datepicker" onchange="changeFechas(this.value)" required value="{{ $participante['fecha_nacimiento'] }}">
                                <label>Fecha de nacimiento</label>
                            </div>
                        </div>
                        <div class="row">
                            <div id="progreso" class="col s12" style="display: none">
                                <div class="progress">
                                    <div class="indeterminate"></div>
                                </div>
                            </div>
                            <div class="input-field col s12 m4">
                                <select name="pais_id" onchange="buscarEstados(this.value)">
                                    <option value="" disabled selected>Seleccione</option>
                                    @foreach ($paises as $row)
                                    <option {{ $row['id'] == $participante['pais_id'] ? 'selected' : '' }} value="{{ $row['id'] }}">{{ $row['nombre'] }}</option>
                                    @endforeach
                                </select>
                                <label>País</label>
                            </div>
                            <div class="input-field col s12 m4">
                                <select id="estados" name="estado_id">
                                    <option value="" disabled selected>Seleccione</option>
                                </select>
                                <label>Estado</label>
                            </div>
                        </div>
                        <button type="submit" class="waves-effect waves-light btn"><i class="material-icons left">save</i>GRABAR</button>
                        <a href="{{ route('participante.index') }}" class="waves-effect waves-light btn-flat">CANCELAR</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
    function buscarEstados(pais) {
        var url = "{{ url('paises/buscarEstados') }}";
        var data = '{"pais": '+pais+'}';
        var xhttp = new XMLHttpRequest();
        var progreso = document.getElementById('progreso');
        xhttp.addEventListener("readystatechange", function() {
            if (this.readyState === 4) {
                var estados = JSON.parse(this.responseText);
                var select = document.getElementById('estados');
                var html = '';
                estados.forEach(function(item){
                    html += '<option value=' + item.id + '>' + item.nombre + '</option>';
                });
                select.innerHTML = html;
                var elems = document.querySelectorAll('select');
                var instances = M.FormSelect.init(elems);
            }
        });
        xhttp.open("POST", url);
        xhttp.setRequestHeader("Content-type", "application/json");
        xhttp.send(data);
    }
    function changeFechas(fecha) {
        var splitFecha, fechaYmd;
        if (fecha.length === 10) {
            splitFecha = fecha.split("/");
            fechaYmd = splitFecha[2] + "-" + splitFecha[0] + "-" + splitFecha[1];
        } else
            return;

        document.getElementById("fecha_nacimiento").value = fechaYmd;
    }
</script>
@endsection
