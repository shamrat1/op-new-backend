@php
    $roles = auth()->user()->roles;
    $roles->reject(function($role){
        return $role->name != "Admin" || $role->name != "Admin1";
    });
    $isAdmin = count($roles->where('name','Admin')) > 0 || count($roles->where('name','Admin1')) > 0;
    $correctBets = $match->BetsForMatch->pluck("correctBet")->toArray();
@endphp
<div class="row">
    <table class="table" id="bidsTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Bet Option</th>
                <th>Bet name</th>
                <th>Bet Value</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Return</th>
                <th>Added On</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($match->bids as $item)
            {{-- @dd() --}}
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->user->username }}</td>
                    <td>{{ !empty($item->betDetail) ? $item->betDetail->betsForMatch->betOption->name : 'Bet Option Detail is deleted' }}</td>
                    <td>{{ $item->bet_name }}</td>
              
                    <td>{{ $item->bet_value }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>
                        @if(in_array($item->bet_option_detail_id,$correctBets))
                            <p class="badge badge-success">Win</p>
                        @else
                            <p class="badge badge-info">Loss / Not Published</p>
                        @endif
                        {{-- @dd($item->bet_option_detail_id) --}}
                        <!-- @php
                            $correct = in_array($item->bet_option_detail_id,$correctBets);
                        @endphp
                        @if ($correct)
                            @php
                                $return = true     
                            @endphp
                            <p class="badge badge-success">Win</p>
                        @else
                            @php
                                $return = false     
                            @endphp
                            
                            @if ($correct == "not set")
                                <p class="badge">Not set</p>
                            @else
                            @endif
                        @endif -->
                    </td>
                    <td>{{ $return ? $item->amount * $item->bet_value : 0 }}</td>
                    <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y h:i A') }}</td>
                    <td>
                        @if (!empty($item->betDetail) && $isAdmin && !$item->betDetail->betsForMatch->isResultPublished)
                            <form action="{{ route('transactions.refund') }}" method="post">
                                @csrf
                                <input type="hidden" name="placed_bet_id" value="{{ $item->id }}">
                                <input type="hidden" name="user_id" value="{{ $item->user_id }}">
                                <input type="hidden" name="amount" value={{ $item->amount }}>
                                <button class="btn btn-danger">Refund</button>  
                            </form>
                        @endif
                    </td>
                </tr>    
            @endforeach
        </tbody>
    </table>
</div>

@push("js")

    $("#bidsTable").datatable();

@endpush