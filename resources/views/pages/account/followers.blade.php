@extends('layouts.master-auth')
@section('title','My Followers')

  @php
      $user = Auth()->user();
  @endphp

@section('content')
<section class="history">      
  <div class="container mt-2">
      <div class="row card rounded elevation accent_bg my-3">
        <div class="card-body">
        <h2 class="hello">HELLO,</h2>
        <p class="userName">{{ Auth()->user()->username }} || @if ($type === 'sponser')
            Sponsered Users
            @else
            Club: {{ $type->name }}
        @endif</p>
          <div class="row">
            @foreach($followers as $follower)
            <div class="col-12 mx-1 rounded border my-1 p-3">
                <div class="col">
                Username: {{$follower->username}} <br>
                Mobile: {{$follower->mobile}} <br>
                </div>
                <div class="col">
                Joined: {{ Carbon\Carbon::parse($follower->created_at)->format('d M Y') }}
&nbsp;
@role('Club Owner')                <button id="viewBets" class="btn btn-sm action_accent text-white" data-toggle="modal" data-target="#betsModal" data-records="{{ $follower->placedBets }}"><i class="fa fa-eye"></i></button>
@endrole
                </div>
            </div>
            @endforeach
          </div>
          <!-- <table class="table table-bordered table-responsive">
            <thead>
              <tr>
                <th scope="col">User ID</th>
                <th scope="col">Phone</th>
                <th scope="col">Join Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @role('Club Owner')
                @foreach ($followers as $follower)
                    <tr>
                      <td>{{ $follower->username }}</td>
                      <td>{{ $follower->mobile }}</td>
                      
                      <td>{{ Carbon\Carbon::parse($follower->created_at)->format('d M Y') }}</td>
                      <td> <button id="viewBets" class="btn btn-success" data-toggle="modal" data-target="#betsModal" data-records="{{ $follower->placedBets }}">View recent bets</button> </td>
                    </tr>
                @endforeach
              @else
                @foreach ($followers as $follower)
                    <tr>
                      <td>{{ $follower->username }}</td>
                      <td>{{ $follower->mobile }}</td>
                      <td>{{ Carbon\Carbon::parse($follower->created_at)->format('d M Y') }}</td>
                    </tr>
                @endforeach
              @endrole
            </tbody>
          </table> -->
          <button type="submit" class="btn primary action_accent text-white">MY PROFILE</button>
        </div>
      </div>
  </div>
  <!-- Modal -->
<div class="modal fade" id="betsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Recent Bets</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table style="color:#000 !important" class="table table-dark">
            <thead>
              <tr>
                <th>Match</th>
                <th>Amount</th>
                <th>Placed At</th>
              </tr>
            </thead>
            <tbody class="text-black" id="tbody">
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 </section>
 <script>
    $(document).on('click','#viewBets',function(){
      var bets = $(this).data('records');
      var table = "";
      $.each(bets,function (index,item){
        var tr =   "<tr><td>"+item.match.name+"</td><td>"+item.amount+"</td><td>"+getFormattedDate(new Date(item.created_at))+"</td></tr>";
        table += tr;
      });
      $('#tbody').append(table);
    });
    function getFormattedDate(date) {
    let year = date.getFullYear();
    let month = (1 + date.getMonth()).toString().padStart(2, '0');
    let day = date.getDate().toString().padStart(2, '0');
  
    return month + '/' + day + '/' + year;
}
  </script>
@endsection
