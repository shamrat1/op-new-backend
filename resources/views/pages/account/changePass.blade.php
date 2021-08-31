@extends('layouts.master-auth')
@section('title','Change Password') 
@section('content')
<section class="history">      
  <div class="container">
      <div class="row card rounded elevation accent_bg my-3">
          <div class="card-body col-md-6 col-md-offset-3">
           
              <form action="{{route('user.password.update')}}" method="POST">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @csrf
                <div class="form-group">
                  <p class="for_front">Old Password</p>
                  <input type="password" name="current_password" class="form-control" id="oldpassword" placeholder="Old Password">
                </div>
                <div class="form-group">
                  <p class="for_front">New Password</p>
                  <input type="password" name="password" class="form-control" id="newpassword" placeholder="New Password">
                </div>

                <div class="form-group">
                  <p class="for_front">Confirm Password</p>
                  <input type="password" name="password_confirmation" class="form-control" id="confirmpassword" placeholder="Confirm Password">
                </div>
          
                <button type="submit" class="btn primary action_accent text-white">Change Password</button>
        </form>
          </div>
      </div>
  </div>
 </section>
@endsection