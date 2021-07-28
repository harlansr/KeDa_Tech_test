@extends('layout.main')
@section('title', 'Customer')

@section('container')

{{-- {{dd(auth()->user())}} --}}
<main class="container">
    <div class="bg-light p-5 rounded">
      {{-- <h1>Berhasil Login sebagai {{auth()->user()->email}}</h1> --}}
      <h1>Customer Page</h1>
      <p class="lead">You can see all customer.</p>

      <ul class="list-group">
        @foreach( $user as $us )
        <li class="list-group-item d-flex  justify-content-between align-item-center">
            <tr>
              <div class="ms-2 mt-1 row">
                  <div class="col-sm-12">{{$us->email}}</div>
              </div>
              <div class="ms-2 ">
                @if (auth()->user()->id != $us->id)
                  <a class="btn btn-primary" href="message/{{$us->id}}" role="button">Message</a>

                  @if (auth()->user()->user_type_id == 1)
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#report{{$us->id}}">
                      Report
                    </button>
                  @else
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$us->id}}">
                      Delete
                    </button>
                  @endif

                @endif
                
                
              </div>

              
              
                
            </tr>
        </li>

        <!-- Modal Report -->
        <div class="modal fade" id="report{{$us->id}}" tabindex="-1" role="dialog" aria-labelledby="reportModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="POST" action="/customer">
                @csrf
              <div class="modal-body">
                <p>Do you want to report <b>{{$us->email}}</b></p>
                <input class="form-control" placeholder="Reason" type="text" name="reason" value="" required>
              </div>
              
                <div class="modal-footer">
                  <input type="hidden" name="id" value="{{$us->id}}">
                  <input type="hidden" name="action" value="report">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-warning">Report</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Modal Delete -->
        <div class="modal fade" id="delete{{$us->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Do you want to delete <b>{{$us->email}}</b></p>
              </div>
              <form method="POST" action="/customer">
                @csrf
                <div class="modal-footer">
                  <input type="hidden" name="id" value="{{$us->id}}">
                  <input type="hidden" name="action" value="delete">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger">Delete</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        @endforeach
      </ul>
      {{$user->links()}}

    </div>
  </main>





@endsection