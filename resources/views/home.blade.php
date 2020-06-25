@extends('layouts.app')

@section('content')
<header>
    <div class="row mb-1">
        <div class="col s12">
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="medium material-icons">menu</i></a>
            <h4>Tablero de control</h4>
        </div>
    </div>
</header>
<main>
    <div class="row">
        <div class="col s12">
            <div class="card hoverable">
                <div class="card-content">
                    <span class="card-title titulos">Registros de usuarios en la aplicación</span>
                    <p>
                        <img src="{{url('/img/demo-grafico.jpg')}}" alt="" class="responsive-img">
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
