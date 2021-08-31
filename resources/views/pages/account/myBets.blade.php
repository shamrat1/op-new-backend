@extends('layouts.master-auth')
@section('title','Bet History')

@section('content')
<section class="history">
  <div class="container">
      <div class="row card rounded elevation accent_bg my-3">
          <div class="card-body col-12">
            <p class="totalg">Total Game: <span>{{ count($totalMatches) }}</span></p>
            <table class="table table-responsive">
            <tbody>
              @foreach($placedBets as $bet)
              @php
                $betsForMatch = $bet->betDetail->betsForMatch;
              @endphp
              <tr>
                <td>{{ $bet->match->tournament->name }}</td>
                <td>{{ $bet->match->team1." v ".$bet->match->team2}}</td>
                <td>
                  @php
                      $option = $betsForMatch->betOption;
                  @endphp
                  @if (!empty($option))
                      {{ $option->name }}
                  @endif
                </td>
                <td>{{ $bet->bet_name }}</td>
                <td>{{ $bet->bet_value }}</td>
                <td>{{ $bet->amount }}</td>
                <td>
                  @if($betsForMatch->isResultPublished)
                    @if ($betsForMatch->correctBet == $bet->betDetail->id)
                        <span class="badge badge-success">Win</span>
                    @else
                        <span class="badge badge-danger">Loss</span>
                    @endif
                  @endif
                </td>
                <td>{{ Carbon\Carbon::parse($bet->created_at)->format("d-m-Y h:i A") }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
            {{$placedBets->links()}}
          </div>
       </div>
  </div>
</section>
@endsection
