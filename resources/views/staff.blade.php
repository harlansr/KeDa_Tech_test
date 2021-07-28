@extends('layout.main')
@section('title', 'Customer')

@section('container')

{{-- {{dd(auth()->user())}} --}}
<main class="container">
    <div class="bg-light p-5 rounded">
      {{-- <h1>Berhasil Login sebagai {{auth()->user()->email}}</h1> --}}
      <h1>Staff Page</h1>
      <p class="lead">You can see all staff.</p>

      <ul class="list-group">
        @foreach( $user as $us )
        <li class="list-group-item d-flex  justify-content-between align-item-center ">
            <tr>
              <div class="ms-2 row ">
                  <div class="mt-1 col-sm-12">{{$us->email}}</div>
              </div>
              @if (auth()->user()->id != $us->id)
                <a class="btn btn-primary" href="message/{{$us->id}}" role="button">Message</a>
              @endif
            </tr>
        </li>
        @endforeach
      </ul>
      {{$user->links()}}

    </div>
  </main>

@endsection