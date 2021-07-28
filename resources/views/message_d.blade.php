@extends('layout.main')
@section('title', 'Customer')

@section('container')

{{-- {{dd(auth()->user())}} --}}
<main class="container">
    <div class="bg-light p-5 rounded">
      {{-- <h1>Berhasil Login sebagai {{auth()->user()->email}}</h1> --}}
      <h1>Personal Message</h1>
      {{-- <p class="lead">You can see all customer.</p> --}}

      <ul class="list-group">
        <form class="form-inline my-2 my-lg-0" method="POST" action="/message/{{$id}}">
            @csrf
            <input class="form-control mr-sm-2" name="message" type="input" placeholder="Send Message" maxlength=255 value="" autocomplete="off" style="min-width: 320px;">
            <button class="btn btn-info my-2 my-sm-0" type="submit">Send</button>
        </form>

        @foreach( $message as $msg )
        <li class="list-group-item d-flex  justify-content-between align-item-center">
            <tr>
              <div class="ms-2">
                  <div class="col-sm-12 fw-bold">{{$msg->email}}</div>
                  <div class="col-sm-12">{{$msg->message}}</div>
              </div>
                
            </tr>
        </li>
        @endforeach
      </ul>
      {{$message->links()}}

    </div>
  </main>

@endsection