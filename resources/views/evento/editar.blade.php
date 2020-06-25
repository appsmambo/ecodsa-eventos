@extends('layouts.app')

@section('content')
<header>
    <div class="row mb-1">
        <div class="col s12">
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="medium material-icons">menu</i></a>
            <h4>Editar evento</h4>
        </div>
    </div>
</header>
<main>
    <div class="row">
        <div class="col s12">
            <div class="card hoverable">
                <div class="card-content">
                    <form method="POST" action="{{ route('evento.grabar') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $evento['id'] }}">
                        <input type="hidden" name="actividades" id="inputActividades" value="{{ $actividades }}">
                        <input type="hidden" name="fecha_inicial" id="fecha_inicial" value="{{ $evento['fecha_inicial'] }}">
                        <input type="hidden" name="fecha_final" id="fecha_final" value="{{ $evento['fecha_final'] }}">
                        <div class="row">
                            <div class="col s12 m6 l8">
                                <div class="row">
                                    <div class="input-field col s12 m4">
                                        <select name="asociacion_id" required>
                                            <option value="" disabled selected>Seleccione</option>
                                            @foreach ($asociaciones as $row)
                                            <option {{ $row['id'] == $evento['asociacion_id'] ? 'selected' : '' }} value="{{ $row['id'] }}">{{ $row['nombre'] }}</option>
                                            @endforeach
                                        </select>
                                        <label>Asociación</label>
                                    </div>
                                    <div class="input-field col s12 m4">
                                        <select name="categoria" required>
                                            <option value="" disabled selected>Seleccione</option>
                                            <option {{ $evento['categoria'] == '3' ? 'selected' : '' }} value="3">Conferencia</option>
                                            <option {{ $evento['categoria'] == '1' ? 'selected' : '' }} value="1">Congreso</option>
                                            <option {{ $evento['categoria'] == '5' ? 'selected' : '' }} value="5">Convención</option>
                                            <option {{ $evento['categoria'] == '6' ? 'selected' : '' }} value="6">Curso</option>
                                            <option {{ $evento['categoria'] == '7' ? 'selected' : '' }} value="7">Evento</option>
                                            <option {{ $evento['categoria'] == '2' ? 'selected' : '' }} value="2">Exposición</option>
                                            <option {{ $evento['categoria'] == '4' ? 'selected' : '' }} value="4">Feria</option>
                                        </select>
                                        <label>Categoría</label>
                                    </div>
                                    <div class="input-field col s12 m4">
                                        <select name="estatus" required>
                                            <option value="" disabled selected>Seleccione</option>
                                            <option {{ $evento['estatus'] == '1' ? 'selected' : '' }} value="1">Visible</option>
                                            <option {{ $evento['estatus'] == '2' ? 'selected' : '' }} value="2">Historico</option>
                                            <option {{ $evento['estatus'] == '3' ? 'selected' : '' }} value="3">Oculto</option>
                                        </select>
                                        <label>Estatus</label>
                                    </div>
                                    <!-- -->
                                    <div class="input-field col s12">
                                        <input name="nombre" type="text" maxlength="200" required value="{{ $evento['nombre'] }}">
                                        <label>Nombre</label>
                                    </div>
                                    <!-- -->
                                    <div class="input-field col s12">
                                        <textarea name="descripcion" class="materialize-textarea" maxlength="500">{{ $evento['descripcion'] }}</textarea>
                                        <label>Descripción</label>
                                    </div>
                                    <!-- -->
                                    <div class="input-field col s12 m6">
                                        <input name="ciudad" type="text" maxlength="200" required value="{{ $evento['ciudad'] }}">
                                        <label>Ciudad y estado</label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <input name="sede" type="text" maxlength="200" required value="{{ $evento['sede'] }}">
                                        <label>Sede</label>
                                    </div>
                                    <!-- -->
                                    <div class="input-field col s12 m6">
                                        <input type="text" class="datepicker" onchange="changeFechas(this.value, true)" required value="{{ $evento['fecha_inicial'] }}">
                                        <label>Fecha inicial</label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <input type="text" class="datepicker" onchange="changeFechas(this.value, false)" required value="{{ $evento['fecha_final'] }}">
                                        <label>Fecha final</label>
                                    </div>
                                    <!-- -->
                                    <div class="col s12 m6">
                                        <label>Tarifa: Registro por fecha</label>
                                        <div class="switch">
                                            <label>
                                                No
                                                <input name="tarifa" type="checkbox" value="1" {{ $evento['tarifa'] == '1' ? 'checked' : '' }}>
                                                <span class="lever"></span>
                                                Sí
                                            </label>
                                        </div>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <input name="nomenclatura" type="text" maxlength="200" required value="{{ $evento['nomenclatura'] }}">
                                        <label>Nomenclatura</label>
                                    </div>
                                    <!-- -->
                                    <div class="input-field col s12 m6">
                                        <input name="responsable" type="text" maxlength="200" required value="{{ $evento['responsable'] }}">
                                        <label>Responsable</label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <input name="responsable_email" type="email" maxlength="200" required value="{{ $evento['responsable_email'] }}">
                                        <label>Email responsable</label>
                                    </div>
                                    <!-- -->
                                    <div class="input-field col s12 m6">
                                        <input name="url_formulario_inscripcion" type="url" maxlength="200" value="{{ $evento['url_formulario_inscripcion'] }}">
                                        <label>Url del formulario de inscripción</label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <input name="url_formulario_reservacion" type="url" maxlength="200" value="{{ $evento['url_formulario_reservacion'] }}">
                                        <label>Url del formulario de reservación</label>
                                    </div>
                                    <!-- -->
                                    <div class="input-field col s12 m6">
                                        <input name="url_programa" type="url" maxlength="200" value="{{ $evento['url_programa'] }}">
                                        <label>Url del programa</label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <input name="url_programa_externo" type="url" maxlength="200" value="{{ $evento['url_programa_externo'] }}">
                                        <label>Url externo del programa</label>
                                    </div>
                                    <!-- -->
                                    <div class="col s12">
                                        <h5>Información posterior al evento</h5>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <input name="numero_inscripciones" type="number" value="{{ $evento['numero_inscripciones'] }}">
                                        <label>Número de inscripciones</label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <input name="numero_asistentes" type="number" value="{{ $evento['numero_asistentes'] }}">
                                        <label>Número de asistentes</label>
                                    </div>
                                    <!-- -->
                                    <div class="input-field col s12">
                                        <textarea name="resena" class="materialize-textarea" maxlength="500">{{ $evento['resena'] }}</textarea>
                                        <label>Reseña</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l4">
                                <div class="card">
                                    <div class="card-content">
                                        <img src="{{ asset('storage/' . $evento['imagen']) }}" alt="" class="responsive-img" id="logoPreview">
                                        <div class="file-field input-field">
                                            <div class="btn">
                                                <span>Logo</span>
                                                <input type="file" name="imagen" id="logo" accept="image/x-png, image/jpeg">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- -->
                                <div class="card">
                                    <div class="card-content">
                                        <span class="card-title">
                                            Actividades <a href="#modalActividad" class="btn-floating btn-small waves-effect waves-light modal-trigger"><i class="material-icons">add</i></a>
                                        </span>
                                        <div id="actividades"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="waves-effect waves-light btn"><i class="material-icons left">save</i>GRABAR</button>
                        <a href="{{ route('evento.index') }}" class="waves-effect waves-light btn-flat">CANCELAR</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Modal Structure -->
<div id="modalActividad" class="modal">
    <div class="modal-content">
        <div class="card">
            <div class="card-content">
                <span class="card-title">Nueva actividad</span>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="actividadNombre" type="text">
                        <label>Nombre de la actividad</label>
                        <span class="helper-text">Por ejemplo: Acceso, Salida, Desayuno, Ponencia</span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="actividadDescripcion" type="text">
                        <label>Descripción de la actividad</label>
                        <span class="helper-text" >Puede utilizar este espacio para dar indicaciones a los responsables de las actividades</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" id="cerrarModal" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
        <a href="#!" onclick="agregarActividad()" class="waves-effect waves-green btn">Agregar</a>
    </div>
</div>
@endsection

@section('scripts')
<script>
    @php
    echo "var actividades = JSON.parse('$actividades');";
    @endphp

    var inputNombre = document.getElementById("actividadNombre");
    var inputDescripcion = document.getElementById("actividadDescripcion");
    var inputActividades = document.getElementById("inputActividades");
    var tablaActividades = document.getElementById("actividades");
    var manana = new Date();
    manana.setDate(new Date().getDate() + 1);
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.datepicker');
        var options = {
            format: "mm/dd/yyyy",
            autoClose: true,
            minDate: manana,
        };
        M.Datepicker.init(elems, options);
    });
    document.getElementById("logo").onchange = function () {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("logoPreview").src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    };
    function changeFechas(fecha, inicio) {
        var splitFecha, fechaYmd;
        if (fecha.length === 10) {
            splitFecha = fecha.split("/");
            fechaYmd = splitFecha[2] + "-" + splitFecha[0] + "-" + splitFecha[1];
        } else
            return;

        if (inicio)
            document.getElementById("fecha_inicial").value = fechaYmd;
        else
            document.getElementById("fecha_final").value = fechaYmd;
    }
    function agregarActividad() {
        var actividad = {};
        if (inputNombre.value.length > 0 && inputDescripcion.value.length > 0) {
            actividad.nombre = inputNombre.value;
            actividad.descripcion = inputDescripcion.value;
            actividades.push(actividad);
            inputNombre.value = '';
            inputDescripcion.value = '';
            document.getElementById("cerrarModal").click();
        } else {
            if (inputNombre.value.length == 0)
                inputNombre.focus();
            if (inputDescripcion.value.length == 0)
                inputDescripcion.focus();
            return false;
        }
        actualizarActividades();
    }
    function actualizarActividades() {
        tablaActividades.innerHTML = '';
        var items = '[';
        actividades.forEach(function(item, index) {
            items += JSON.stringify(item) + ',';
            var texto = '<p class="actividad"><strong>' + item.nombre + '</strong> <br> ' + item.descripcion + '<span class="red quitar white-text" onclick="quitarActividad('+index+')">X</span></p>';
            tablaActividades.insertAdjacentHTML("beforeend", texto);
        });
        inputActividades.value = items.slice(0, -1) + ']';
    }
    function quitarActividad(index) {
        delete(actividades[index]);
        actualizarActividades();
    }
    actualizarActividades();
</script>
@endsection
