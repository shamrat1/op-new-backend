<div class="card mt-3 elevation-2">
    <div class="card-body">
        <div class="row">
            @foreach ($match->betsForMatch as $item)
                <div class="card col-sm-3 m-2">
                    <div class="card-body">
                        <strong>{{$item->betOption->name}}</strong>
                    <form action="{{ route('bet.correct',$item->id) }}" method="POST" id="actionForm-{{ $item->id }}">
                        @csrf
                        <select name="correctBet" data-id="{{ $item->id }}" id="correctBet" class="custom-select">
                                <option value="">Select Correct One</option>
                                @foreach ($item->betDetails as $detail)
                                    <option value="{{ $detail->id }}" {{ $item->correctBet == $detail->id  ? "selected" : "" }}>{{ $detail->name }}</option>
                                @endforeach
                            </select>
                        <small class="text-muted">{{ empty($item->correctBet) ? "correct option not set yet" : "correct option set" }}</small>
                        <div class="row m-1">
                            @php
                                $ids = $item->betDetails->pluck('id')->toArray();
                                // dd($ids);
                                $sum = $match->bids->whereIn('bet_option_detail_id',$ids)->sum('amount');
                                // dd($sum);
                            @endphp
                            <span class="badge badge-success">bids {{ $sum }}</span>
                        </div>
                    </form>
                        <br>
                        <div class="row justify-content-between">
                            <div class="col">
                                @if ($item->isResultPublished)
                                <a href="#" class="disabled btn btn-sm btn-outline-success">Result Published</a>
                                @else
                                    @if ($item->correctBet != null)
                                        <form action="{{ route('bet.publish-result',$item->id) }}" method="POST" id="publishResultForm-{{ $item->id }}">
                                            @csrf
                                            <input type="hidden" name="match_id" value="{{ $match->id }}">
                                            <button type="button" data-id="{{ $item->id }}" class="btn btn-sm btn-outline-success" id="publishResultButton">publish result</button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                            <div class="col">
                                @if (!$item->isResultPublished && $item->correctBet == null)
                                    <form action="{{ route('bet.publish.noresult',$item->id) }}" method="POST" id="noResultForm-{{ $item->id }}">
                                        @csrf
                                        <input type="hidden" name="match_id" value="{{ $match->id }}">
                                        <button type="button" data-id="{{ $item->id }}" class="btn btn-sm btn-danger" id="noResultButton">No Result</button>
                                    </form>
                                @endif
                            </div>
                        
                            <div class="col text-right">
                                <form action="{{ route('bet.status',$item->id) }}" method="POST" id="betStatusForm-{{ $item->id }}">
                                    @csrf
                                    @php
                                        $class = $item->isLive ? "btn-danger" : "btn-success";
                                        $text = $item->isLive ? "Off" : "On"; 
                                    @endphp
                                    @if (!$item->isResultPublished)
                                        <button data-id="{{ $item->id }}" id="betStatusButton" data-status="{{ $text }}" type="button" class="btn btn-sm {{ $class }}">{{ $text }}</button>                            
                                    @endif
                                    
                                </form>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <form action="{{ route('bet.score',$item->id) }}" method="POST" class="col">
                                @csrf
                                <button type="submit" class="btn btn-block {{ $item->score ? 'btn-danger' : 'btn-success' }}">{{ $item->score ? 'Score Off' : 'Score On' }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
