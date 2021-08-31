
@extends('layouts.master-auth')
@section('title','Verify Your email')

@section('content')
<section class="reg">      
  <div class="container">
      <div class="row">
          <div class="col-md-4 col-md-offset-4">
           <div class="card well">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    <p>{{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}</p> <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div> 
    </div>
</div>
</div>
</section>
@endsection
