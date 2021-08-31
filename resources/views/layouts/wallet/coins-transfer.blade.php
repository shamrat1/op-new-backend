@extends('layouts.master-auth')
@section('title','Transfer Coins')
@section('content')

<section class="deposit">      
  <div class="container">
  <div class="row card rounded elevation accent_bg my-3">
      <div class="card-body col-md-4 col-md-offset-4">
      <div class="row mb-3">
                  <div class="col text-center">
                      <h5 class="text-white">Transfer Coins</h5>
                  </div>
              </div>
      @if(session('success'))
                     <div class="alert alert-success">
                        <strong>Success!</strong> {{ session('success') }}
                     </div>
       @endif
        
        <form action="{{ route('coin-transfer.store') }}" method="post">
          @csrf             
          
          <div class="form-group">
            <p class="for_front">Coins (20-{{ $credit >= '25020' ? '25000' : $credit - 20 }})</p>
            <input type="number" required class="form-control" id="number" name="amount" placeholder="20-{{ $credit >= '25020' ? '25000' : $credit - 20 }}" min="20" max="{{ $credit >= '25020' ? 25000 : $credit - 20 }}">
            @error('amount') <small class="text-danger">{{$message}}</small>@enderror

          </div>
          
          <div class="form-group">
            <p class="for_front">Receiver's Username</p>
            <input type="text" class="form-control" id="Username" name="username" required>
            @error('username') <small class="text-danger">{{$message}}</small>@enderror

          </div>
          <div class="form-group">
            <p class="for_front">Password</p>
            <input type="password" name="password" required class="form-control" id="pwd" placeholder="Password">
            @error('password') <small class="text-danger">{{$message}}</small>@enderror

          </div>
          

          <button type="submit" class="btn btn-block action_accent text-white">Send coin</button>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection
