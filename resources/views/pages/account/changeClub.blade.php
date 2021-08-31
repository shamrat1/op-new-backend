@extends('layouts.master-auth')
@section('title','Change Club')

@php
    $selectedClub = auth()->user()->club->id;
@endphp
 
@section('content')
<section class="history">      
  <div class="container">
      <div class="row card rounded elevation accent_bg my-3">
          <div class="card-body col-md-6 col-md-offset-3">
            <form action="{{ route('club.update') }}" method="POST">
              @csrf
                <div class="form-group">
                  <p class="for_front">Select Club</p>
                  <select id="club" name="club_id" class="form-control" @isset($selectedClub)
                            readonly
                        @endisset>
                            <option value="">Select Club</option>
                            @foreach($clubs as $club)
                                <option value="{{ $club->id }}"
                                    @isset($selectedClub)
                                        @if ($club->id == $selectedClub)
                                            selected
                                        @endif
                                    @endisset
                                >{{ $club->name }}</option>
                            @endforeach   
                        
                                                
                        </select>
                </div>
                <div class="form-group">
                  <p class="for_front">Your Password</p>
                  <input type="password" name="password" class="form-control" id="pwd" placeholder="Password">
                </div>

                <button type="submit" class="btn primary action_accent">Change</button>
              </form>  
          </div>
       </div>
  </div>
</section>
@endsection