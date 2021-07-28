<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
      {{-- <a class="navbar-brand" href="#">KeDa Tech</a> --}}
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{url('/customer')}}">Customer</a>
          </li>
  
          @if (auth()->user()->user_type_id == 2)
          <li class="nav-item">
              <a class="nav-link active" href="{{url('/staff')}}">Staff</a>
          </li>
          @endif

          <li class="nav-item">
            <a class="nav-link active" href="{{url('/message')}}">Message</a>
          </li>

          @if (auth()->user()->user_type_id == 2)
          <li class="nav-item">
              <a class="nav-link active" href="{{url('/message_all')}}">All Message</a>
          </li>
          @endif
  
          {{-- <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li> --}}
        </ul>
        <form class="d-flex">
          {{-- <li class="nav-item"> --}}
            @if (auth()->user()->user_type_id == 1)
              <a class="nav-link active" href="{{url('/feedback')}}">Feedback</a>
            @else
              <a class="nav-link active" href="{{url('/feedbacks')}}">All Feedback</a>
            @endif
            {{-- </li> --}}
            <a class="btn btn-outline-success" href="{{url('/logout')}}">Logout</a>
        </form>
      </div>
    </div>
  </nav>