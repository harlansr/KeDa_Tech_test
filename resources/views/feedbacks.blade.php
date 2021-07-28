@extends('layout.main')
@section('title', 'Feedbacks')

@section('container')

{{-- {{dd(auth()->user())}} --}}
<main class="container">
    <div class="bg-light p-5 rounded">
      {{-- <h1>Berhasil Login sebagai {{auth()->user()->email}}</h1> --}}
      <h1>All Feedback</h1>
      <ul class="list-group">
        @foreach( $feedback as $fb )
        <li class="list-group-item  align-item-center">
            <tr>
                {{-- <th scope="row">{{$loop->iteration}}</th> --}}
                
                <div class="ms-2 row fw-bold">
                    {{-- <td>{{$fb->email}}</td> --}}
                    <div class="col-sm-12">{{$fb->email}}</div>
                </div>
                <div class="ms-2 row">
                    {{-- <td>{{$fb->message}}</td> --}}
                    <div class="col-sm-12">{{$fb->message}}</div>
                </div>
                
            </tr>
        </li>
        @endforeach
      </ul>
      {{$feedback->links()}}
    </div>
  </main>

@endsection