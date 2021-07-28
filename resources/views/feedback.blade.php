@extends('layout.main')
@section('title', 'Feedback')

@section('container')

{{-- {{dd(auth()->user())}} --}}
<main class="container">
    <div class="bg-light p-5 rounded">
      {{-- <h1>Berhasil Login sebagai {{auth()->user()->email}}</h1> --}}
      <h1>Feedback</h1>
      {{-- <p class="lead">Now you can see all customer.</p> --}}
      <form method="POST" action="/feedback">
        @csrf
        <div class="input-group">
          <textarea type="text" name = "message" id = "message" class="form-control" aria-label="With textarea" style="min-height: 200px;"></textarea>
        </div>
        <button type="submit" class="mt-2 btn btn-primary">Send Feedback &raquo;</button>
      </form>

    </div>
  </main>

@endsection