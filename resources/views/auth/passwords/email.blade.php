@extends('layouts.master-auth')
@section('title','Reset Password')
@section('style')
    <style>
        .reg{
            padding-top: 20px;
            padding-bottom: 60px;
            background-color: #4987B8;;
        }
        
    </style>
@endsection
@section('content')
<section class="reg">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header" style="color: white;">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="well">
                        <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            
                                
                            

                            <div class="col-md-6">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

@endsection
