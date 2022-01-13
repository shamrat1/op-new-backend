@extends('layouts.master-auth')
@section('title','New Deposit')

@section('content')

@php
  $methodsetting = $settings->where('key','payment-method')->first()->value ?? '';
  $methods = [];
  $methods = explode(",",$methodsetting);
  $backendNumber = [];
  foreach ($methods as $value) {
    $backendNumber[$value] = $settings->where('key',$value)->first()->value ?? '';
  }
@endphp
<section class="deposit">      
  <div class="container">
    <div class="row card rounded elevation accent_bg my-3">
      <div class="card-body col-md-4 col-md-offset-4">
      <div class="row mb-3">
                  <div class="col text-center">
                      <h5 class="text-white">New Deposit</h5>
                  </div>
              </div>
        <form action="{{ route('transactions.store') }}" method="post">
          @csrf
          <div class="form-group">
            <p class="for_front">Payment Method</p>
            <select id="payment_method" name="payment_method"
            @foreach ($backendNumber as $key => $value)
              data-{{$key}}={{$value}}
            @endforeach
            class="form-control">
              <option value="">Select Method</option>
              @foreach ($methods as $method)
              <option value="{{ $method }}">{{ Str::ucfirst($method) }}</option>
              @endforeach
              <!-- <option value="paypal">Paypal</option>    -->
            </select>
            @error('payment_method') <small class="text-danger">{{$message}}</small>@enderror
          </div>
          <div class="form-group">
            <p class="for_front">Total Amount ({{ $paymentSetting->lowest_amount.'-'.$paymentSetting->highest_amount }})</p>
            <input type="number" required class="form-control" id="number" name="amount" placeholder="{{ $paymentSetting->lowest_amount.'-'.$paymentSetting->highest_amount }}" min="{{$paymentSetting->lowest_amount}}" max="{{$paymentSetting->highest_amount}}">
            @error('amount') <small class="text-danger">{{$message}}</small>@enderror

          </div>
          <div class="form-group">
            <p class="for_front">Number From</p>
            <input type="text" class="form-control" name="mobile" id="number" required placeholder=" Number">
            @error('mobile') <small class="text-danger">{{$message}}</small>@enderror

            <p class="for_front">Number To <span id="backendMobile">{{ $backendMobile }}</span></p>
            <input type="hidden" name="backend_mobile" value="{{ $backendMobile }}">
          </div>
          {{-- <div class="form-group">
            <p class="for_front">TrxID</p>
            <input type="number" class="form-control" id="number" name="txn_id" >
          </div> --}}
          <div class="form-group">
            <p class="for_front">Password</p>
            <input type="password" name="password" required class="form-control" id="pwd" placeholder="Password">
            @error('password') <small class="text-danger">{{$message}}</small>@enderror

          </div>
          
          <div class="form-group">
            <p class="for_front">Offers</p>
            <select id="campaign_id" name="campaign_id" class="form-control">
              <option value="">Select Offer</option>
              @foreach ($campaigns as $offer)
              <option value="{{ $offer->id }}">{{ Str::ucfirst($offer->name) }}</option>
              @endforeach
              <!-- <option value="paypal">Paypal</option>    -->
            </select>
            @error('payment_method') <small class="text-danger">{{$message}}</small>@enderror
          </div>
          <button type="submit" class="btn btn-block action_accent text-white">Request Coin</button>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection

@push('plugin-scripts')
  <script>
    $(document).on("change","#payment_method",function(){
      $("#backendMobile").html($(this).data($(this).val()));
    });
  </script>
@endpush
