@extends('layouts.master-auth')
@section('title','Withdraw Request')

      @section('content')
      <section class="withdraw">      
       <div class="container">
         <div class="row card rounded elevation accent_bg my-3">
           <div class="card-body col-md-6 col-md-offset-3">
           <div class="row mb-3">
                  <div class="col text-center">
                      <h5 class="text-white">Withdraw Request</h5>
                  </div>
              </div>
            @if($userCredit < 200)
              <div class="alert alert-danger">
                  <h1>You don't have enough coins to make withdraw request.</h1>
              </div>
            @else
          
              @role('Club Owner')
              @if ($setting->withdraw_date == Carbon\Carbon::today()->format('d'))
                <form action="{{ route('withdraw.store') }}" method="Post">
                @csrf
                <div class="form-group">
                  <p class="for_front">Amount (400-{{ $userCredit > 25000 ? 25000 : $userCredit }})</p>
                  <input type="number" class="form-control" name="amount" min="400" max="{{ $userCredit >= '25020' ? '25000' : $userCredit - 20 }}" required id="number" placeholder="400-{{ $userCredit >= '25020' ? '25000' : $userCredit - 20 }}">
                  @error('amount') <small class="text-danger">{{$message}}</small>@enderror

                </div>
              <div class="form-group">
                {{-- <p class="for_front">Number from: <span style="color: red;">check withdraw history later.</span></p> --}}
                <p class="for_front">Password</p>
                <input type="password" class="form-control" name="password" id="pwd" placeholder="Password">
                @error('password') <small class="text-danger">{{$message}}</small>@enderror

              </div>


                <button type="submit" class="btn btn-block action_accent text-white">request withdraw</button>

              @else
                <div class="well">
                <h5>Put withdraw request on the {{ $setting->withdraw_date }}'th of next month. </h5>
                </div>    
              @endif
              @else
            <form action="{{ route('withdraw.store') }}" method="Post">
              @csrf
              <div class="form-group">
                <p class="for_front">Amount (400-{{ $userCredit > 25000 ? 25000 : $userCredit }})</p>
                <input type="number" class="form-control" name="amount" min="400" max="{{ $userCredit >= '25020' ? '25000' : $userCredit - 20 }}" required id="number" placeholder="400-{{ $userCredit >= '25020' ? '25000' : $userCredit - 20 }}">
                @error('amount') <small class="text-danger">{{$message}}</small>@enderror

              </div>
              <div class="form-group">
                <p class="for_front">Phone No</p>
                <input type="text" class="form-control" name="mobile" required id="number" placeholder="Number">
                @error('mobile') <small class="text-danger">{{$message}}</small>@enderror

              </div>              
              <div class="form-group">
                <p class="for_front">Payment Type</p>
                <select id="agent" name="payment_type" class="form-control">
                 <option value="personal">Personal</option>
                 <option value="agent">Agent</option>
               </select>
               @error('payment_type') <small class="text-danger">{{$message}}</small>@enderror

             </div>
             <div class="form-group">
               <p class="for_front">Payment Method</p>
               <select id="agent" name="payment_method" class="form-control">
                 <option value="bkash">Bkash</option>   
                 <!-- <option value="rocket">Rocket</option>
                 <option value="nagad">Nagad</option> -->
               </select>
               @error('payment_method') <small class="text-danger">{{$message}}</small>@enderror

             </div>

             <div class="form-group">
              {{-- <p class="for_front">Number From <span style="color: red;">check withdraw history later.</span></p> --}}
              <p class="for_front">Password</p>
              <input type="password" class="form-control" name="password" id="pwd" placeholder="Password">
              @error('password') <small class="text-danger">{{$message}}</small>@enderror

            </div>

            @isset (auth()->user()->mobile)
              <button type="submit" class="btn btn-block action_accent text-white">request withdraw</button>
            @endisset
          </form>
              @endrole
            @endif
        </div>
      </div>
    </div>
  </section>
  @endsection
