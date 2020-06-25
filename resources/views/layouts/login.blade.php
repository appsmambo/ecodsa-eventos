<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="login">
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
<body class=" valign-wrapper">
  <section class="container">
    @yield('content')
  </section>
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
    M.AutoInit();
  </script>
</body>
</html>
