@extends('layouts.login')

@section('content')
<div class="row">
  <div class="col s12 m10 offset-m1">
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="card horizontal hoverable">
        <div class="card-image fondoSistema valign-wrapper center-align px-4">
          <img src="{{url('/img/logo-ecodsa.png')}}" alt="{{ config('app.name', 'Laravel') }}" class="img-fluid">
        </div>
        <div class="card-stacked">
          <div class="card-content">
            <div class="row">
              <div class="input-field col s12">
                <input id="email" type="email" class="validate @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <label for="email">Correo electrónico</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="password" type="password" class="validate @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                <label for="password">Contraseña</label>
              </div>
            </div>
            @error('email')
            <span class="invalid-feedback red-text" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            @error('password')
            <span class="invalid-feedback red-text" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="card-action">
            <button class="btn waves-effect waves-light" type="submit" name="action">
              INGRESAR <i class="material-icons right">vpn_key</i>
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
