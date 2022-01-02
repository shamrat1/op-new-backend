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
        if($request->has('origin')){
            $matches = Match::with('tournament','betsForMatch', 'betsForMatch.betOption', 'betsForMatch.betDetails')
            ->when($request->sport != 'all',function($q) use($request){
                $q->where('sport_type',$request->sport);
            })
            ->where('status', ($request->status ?? 'live'))
            ->orderBy('match_time')
            ->get();
            return response()->json($matches);
        }
        $matches = Match::with('tournament','betsForMatch', 'betsForMatch.betOption', 'betsForMatch.betDetails')
        ->when($request->sport != 'all',function($q) use($request){
            $q->where('sport_type',$request->sport);
        })
        ->where('status', ($request->status ?? 'live'))
        ->orderBy('match_time')
        ->get();
        $grouped = [];
        $grouped["Cricket"] = $matches->where('sport_type','cricket');
        $grouped["Football"] = $matches->where('sport_type','football');
        $grouped["Basketball"] = $matches->where('sport_type','basketball');
        $grouped["Volleyball"] = $matches->where('sport_type','volleyball');
        $grouped["Tennis"] = $matches->where('sport_type','Tennis');
        return response()->json($grouped);
    }
    
}