@extends('layouts.master-auth')
@section('title','Login')

@section('content')
<section class="reg">      
  <div class="container">
      <div class="row card rounded elevation accent_bg my-3">
          <div class="card-body col-md-4 col-md-offset-4">
              <div class="row mb-3">
                  <div class="col text-center">
                      <h5 class="text-white">Login Now</h5>
                  </div>
              </div>
            @if (session('message'))
                <div class="alert alert-danger">{{ session('message') }}</div>
            @endif
            <form method="post" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                    @error('username') <small class="text-danger">{{$message}}</small>@enderror

                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" id="pwd" placeholder="Password">
                    @error('password') <small class="text-danger">{{$message}}</small>@enderror

                </div>
                <button type="submit" class="btn btn-block action_accent text-white">Login</button>
              <div class="row mt-3">
                <div class="col text-left">
                <a class="text-muted" href="{{ route('password.request') }}">
                    <label >Forgot Password?</label>
                </a> 
                </div>
                <div class="col text-right">

                <a href="{{ route('register') }}" class="text-muted">
                    <label>Register</label>
                </a>
                </div>
              </div>
        </form>
    </div>
</div>
</div>
</section>
@endsection
