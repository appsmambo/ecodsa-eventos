<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link rel="stylesheet" href="{{url('/css/fix-material.css')}}">
  <link rel="stylesheet" href="{{url('/css/main.css')}}">
  <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body class="app">
  <ul id="slide-out" class="sidenav sidenav-fixed">
    <li>
      <div class="user-view center-align">
        <div class="background">
          <img src="{{url('/img/fondo-sidebar.png')}}" alt="{{ config('app.name', 'Laravel') }}">
        </div>
        <img class="circle avatar" src="{{url('/img/demo-user.jpg')}}" alt="{{ Auth::user()->name }}">
        <span class="white-text name">{{ Auth::user()->name }}</span>
        <span class="white-text email">{{ Auth::user()->email }}</span>
      </div>
    </li>
    <li class="{{ Route::is('home.*') ? 'active' : '' }}">
      <a class="waves-effect" href="{{ route('home.index') }}"><i class="material-icons">dashboard</i>Dashboard</a>
    </li>
    <li class="{{ Route::is('evento.*') ? 'active' : '' }}">
      <a class="waves-effect" href="{{ route('evento.index') }}"><i class="material-icons">today</i>Eventos</a>
    </li>
    <li class="{{ Route::is('participante.*') ? 'active' : '' }}">
      <a class="waves-effect" href="{{ route('participante.index') }}"><i class="material-icons">group</i>Participantes</a>
    </li>
    <li class="{{ Route::is('asociacion.*') ? 'active' : '' }}">
      <a class="waves-effect" href="{{ route('asociacion.index') }}"><i class="material-icons">business</i>Asociaciones</a>
    </li>
    <li class="{{ Route::is('asistencia.*') ? 'active' : '' }}">
        <a class="waves-effect" href="{{ route('asistencia.index') }}"><i class="material-icons">playlist_add_check</i>Asistencia</a>
    </li>
    <li class="{{ Route::is('usuario.*') ? 'active' : '' }}">
      <a class="waves-effect" href="{{ route('usuario.index') }}"><i class="material-icons">security</i>Usuarios</a>
    </li>
    <li><div class="divider"></div></li>
    <li>
      <a class="waves-effect" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <i class="material-icons">exit_to_app</i>Cerrar sesión
      </a>
    </li>
  </ul>
  @guest
  <main>
    <div class="row">
      <div class="col s12">
        <h1>No autorizado.</h1>
      </div>
    </div>
  </main>
  @else
  @yield('content')
  @endguest
  <footer>
  </footer>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
    M.AutoInit();
  </script>
  @yield('scripts')
</body>
</html>
