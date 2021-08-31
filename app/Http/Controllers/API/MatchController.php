<?php

namespace App\Http\Controllers\API;

use App\BetOption;
use App\BetOptionDetail;
use App\BetsForMatch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\BetValueSetter;
use App\Tournament;
use App\Match;
use DB;
use Exception;

class MatchController extends Controller
{
    public function getMatches(Request $request)
    {
        $matches = Match::with('tournament','betsForMatch', 'betsForMatch.betOption', 'betsForMatch.betDetails')
        ->when($request->sport != 'all',function($q) use($request){
            $q->where('sport_type',$request->sport);
        })
        ->where('status', ($request->status ?? 'live'))
        ->orderBy('match_time')
        ->get();

        return response()->json($matches);
    }
    
}