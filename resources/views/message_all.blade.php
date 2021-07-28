@extends('layout.main')
@section('title', 'Customer')

@section('container')

{{-- {{dd(auth()->user())}} --}}
<main class="container">
    <div class="bg-light p-5 rounded">
      {{-- <h1>Berhasil Login sebagai {{auth()->user()->email}}</h1> --}}
      <h1>All Message</h1>
      {{-- <p class="lead">You can see all customer.</p> --}}

      <ul class="list-group">
        @foreach( $message as $msg )
        
        
        <li class="list-group-item ">
            
            @if($msg->user_id == auth()->user()->id)
            <a class = "list-group-item list-group-item-action" href="message/{{$msg->from_user_id}}">
            @else
                <a class = "list-group-item list-group-item-action" href="message/{{$msg->user_id}}">
            @endif

            <tr>
              <div class="d-flex align-items-start flex-column">
                <div class="p-2 fw-bold">{{$msg->email}}</div>
                <div class="p-2  d-flex">

                    @if($msg->user_id == auth()->user()->id)
                        <div class="col-sm-12">{{$msg->message}}</div>
                    @else
                        <div style="color:rgb(0, 60, 255);">send> </div>
                        <div class="">{{$msg->message}}</div>
                    @endif

                </div>
                
              </div>
              {{-- <div class="ms-2 ">
                <a class="btn btn-danger" href="#" role="button">Delete</a>
              </div> --}}
                
            </tr>
            </a>
        </li>
        
        @endforeach
      </ul>
      {{-- {{$message->links()}} --}}

    </div>
  </main>

@endsection