@extends('layout.auth')
@section('title', 'Login')

@section('container')

  <div class="container" >
    <main class="form-signin">
      <form method="POST" action="{{route('login')}}">
      {{-- <form method="POST" action=""> --}}
        {{ csrf_field() }}
        {{-- <h1 class="h3 mb-3 fw-normal" style="text-align: left;">Login {{ config('app.name')}}</h1> --}}
        <h2 style="text-align: left; font-weight: bold;">Login</h2>

        <div class="form-floating mt-1">
          <input type="text" name="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" id="floatingInput" value="{{old('email')}}" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required autofocus>
          <label for="floatingInput">Email address</label>
          @if ($errors->has('email'))
            <div class="invalid-feedback">
                {{$errors->first('email')}}
            </div>
          @endif
        </div>

        <div class="form-floating mt-1">
          <input type="password" name='password' class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" id="floatingPassword" placeholder="Password" minlength="6" required>
          <label for="floatingPassword">Password</label>
          @if ($errors->has('password'))
            <div class="invalid-feedback">
                {{$errors->first('password')}}
            </div>
          @endif
        </div>

        <button class="w-100 btn btn-lg btn-primary mt-1" type="submit">Login</button>
        <a href='/register'>Register</a>
      </form>
    </main>
  </div>

@endsection