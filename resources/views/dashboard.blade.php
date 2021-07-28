@extends('layout.main')
@section('title', 'Home Awal')

@section('container')

{{-- {{dd(auth()->user())}} --}}
<main class="container">
    <div class="bg-light p-5 rounded">
      {{-- <h1>Berhasil Login sebagai {{auth()->user()->email}}</h1> --}}
      <h1>Success Login as {{$name}}</h1>
      <p class="lead">Now you can send message to other customer.</p>
      <a class="btn btn-lg btn-primary" href="{{url('/customer')}}" role="button">View all customer &raquo;</a>
    </div>
  </main>

@endsection