@php
   $bids = $match->bids;

@endphp

<div class="row">
    <div class="card elevation-2 mt-3 col-4">
        <div class="card-body">
            <div class="row">
            <div class="col text-left">
                number of bids
            </div>
            <div class="col text-right">
            <span class="badge badge-primary">{{ $bids->count() }}</span>
            </div>
        </div>
        <hr>
    <div class="row">
        <div class="col text-left">
            total amount of bid
        </div>
        <div class="col text-right">
            <span class="badge badge-primary">{{ $bids->sum('amount') }}</span>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col text-left">
            sponser %
        </div>
        <div class="col text-right">
        <span class="badge badge-danger">{{ $bids->sum('amount') * 0.05 }}</span>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col text-left">
            User Win
        </div>
        <div class="col text-right">
            @php
                $userWin = 0;
                $returnToUser = 0;
                $houseHas = 0;
                $correctBets = $match->BetsForMatch->pluck("correctBet")->toArray();
                foreach ($match->bids as $bid) {
                    if(!empty($bid->betDetail) && in_array($bid->betDetail->id,$correctBets)){
                        $returnAmount = $bid->amount * $bid->bet_value;
                        $returnToUser += $returnAmount;
                        $userWin++;
                    }else{
                        $houseHas += $bid->amount;
                    }
                }

                // dd($houseHas,$returnToUser);
            @endphp
        <span class="badge badge-warning">{{ $userWin }}</span>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col text-left">
            user lost
        </div>
        <div class="col text-right">
        <span class="badge badge-danger">{{ $bids->count() - $userWin }}</span>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col text-left">
            number of bids
        </div>
        <div class="col text-right">
        <span class="badge badge-primary">{{ $bids->count() }}</span>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col text-left">
            profit
        </div>
        <div class="col text-right">
            {{-- @dd($houseHas,$returnToUser) --}}
            @if (($bids->sum('amount') - $returnToUser) < 0)
                <span class="badge badge-danger">{{ $bids->sum('amount') - ($bids->sum('amount') * 0.05 + $returnToUser) }}</span>
            @else
                <span class="badge badge-primary">{{ $bids->sum('amount') - ($bids->sum('amount') * 0.05 + $returnToUser) }}</span>
            @endif
        </div>
    </div>
    </div>
</div>
<div class="card card-danger elevation-2 mt-3 ml-3 col-5">
    <div class="card-header">
        <div class="card-title">Edit Match information</div>
    </div>
    <div class="card-body">
    <form action="{{ route('match.update',$match->id) }}" method="POST">
        @csrf
        @method('PUT')
            <div class="row">
                <div class="form-group col">
                    <label for="">Team1</label>
                    <input type="text" class="form-control" name="team1" value="{{ $match->team1 }}">
                </div>
                <div class="form-group col">
                    <label for="">Team2</label>
                    <input type="text" name="team2" class="form-control" value="{{ $match->team2 }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="">Match Time</label>
                <input type="datetime-local" name="match_time" class="date time form-control" value="{{ Carbon\Carbon::parse($match->match_time)->format('Y-m-d\TH:i') }}">
                </div>
                <div class="form-group col">
                    <label for="">Status</label>
                    <select name="status" class="custom-select">
                        <option value="draft" {{ $match->status == "draft" ? "selected" : "" }}>draft</option>
                        <option value="live" {{ $match->status == "live" ? "selected" : "" }}>live</option>
                        <option value="upcoming" {{ $match->status == "upcoming" ? "selected" : "" }}>upcoming</option>
                        <option value="unpublished" {{ $match->status == "unpublished" ? "selected" : "" }}>Unpublished</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="">Tournament</label>
                    <select name="tournament_id" class="custom-select">
                        @foreach ($tournaments as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $match->tournament_id ? "selected" : ""}}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="type">Sports Type</label>
                    <select name="sport_type" id="type" class="custom-select">
                        <option value="">Select Sport Type</option>
                        <option value="cricket" {{ $match->sport_type == "cricket" ? 'selected' : ''}}>cricket</option>
                        <option value="football" {{ $match->sport_type == "football" ? 'selected' : ''}}>football</option>
                        <option value="basketball" {{ $match->sport_type == "basketball" ? 'selected' : ''}}>basketball</option>
                        <option value="volleyball" {{ $match->sport_type == "volleyball" ? 'selected' : ''}}>volleyball</option>
                        <option value="tennis" {{ $match->sport_type == "tennis" ? 'selected' : ''}}>tennis</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="">Tournament Match NO</label>
                        <input type="text" name="tournament_match_no" value="{{ $match->tournament_match_no }}" class="form-control">
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-right">
                <button class="btn btn-warning">Update</button>
            </div>
        </form>
    </div>
</div>
</div>
