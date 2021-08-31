@extends('layouts.master-auth')
@section('title','View Profile')


  @php
      $user = Auth()->user();
  @endphp
   @section('content')
 <section class="view">      
  <div class="container">
      <div class="row my-3">
        <h4 class="col-12 text-white text-center">{{ ucwords(Auth()->user()->name) }}</h4>
        <div class="col-md-4">
          <table class="table text-white">
           <tbody>
            <tr>
              <td>STATUS</td>
              <td>:</td>
              <td>active</td>
            </tr>
            <tr>
              <td>CLUB</td>
              <td>:</td>
              <td>
                @if (!empty(Auth()->user()->club))
                    {{ Auth()->user()->club->name }}
                @endif
              </td>
            </tr> 
            <tr>
              <td>SPONSOR</td>
              <td>:</td>
            <td>{{ Auth()->user()->sponser_email }}</td>
            </tr>  
            <tr>
              <td>EMAIL</td>
              <td>:</td>
            <td>{{ Auth()->user()->email }}</td>
            </tr>  
            <tr>
              <td>PHONE</td>
              <td>:</td>
            <td>{{ Auth()->user()->mobile }}</td>
            </tr>   
            <tr>
              <td>JOINING DATE</td>
              <td>:</td>
            <td>{{ Carbon\Carbon::parse(Auth()->user()->created_at)->format('d-m-y') }}</td>
            </tr>     
           </tbody>
          </table>
        </div>        
      </div>

      <a href="{{route('profile.edit')}}" type="submit" class="btn primary viewbtn action_accent text-white">Edit Profile</a>
  </div>
 </section>
 @endsection

