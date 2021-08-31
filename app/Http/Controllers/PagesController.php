<?php

namespace App\Http\Controllers;

use App\BannerImage;
use Illuminate\Http\Request;
use App\Match;
use App\Http\Traits\UserAccount;
use App\SiteSetting;
use App\BetSetting;
use App\Http\Traits\BetValueSetter;
use App\PaymentSetting;

class PagesController extends Controller
{
    use UserAccount, BetValueSetter;

	public function __constructor(){
		$this->middleware('guest');
	}
	
    public function index(){
    	// $matches = Match::with('tournament','betsForMatch','betsForMatch.betOption','betsForMatch.betDetails')->where('status','live')->orderBy('match_time')->get();
        $siteSetting = SiteSetting::get()->first();
        $betSetting = BetSetting::get()->first();
        // $banner = BannerImage::where('isEnabled',1)->get();
    	// return view('welcome',compact(['matches','siteSetting','betSetting','banner']));
    	return view('welcome',compact(['siteSetting','betSetting']));
    }

    public function apiGetMatches(Request $request)
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

    public function apiGetUpcomingMatches()
    {
        $matches = Match::with('tournament','betsForMatch', 'betsForMatch.betOption', 'betsForMatch.betDetails')->where('status', 'upcoming')->orderBy('match_time')->get();

        return response()->json($matches);
    }

    public function upcomingMatches()
    {
        $matches = Match::with('betsForMatch', 'betsForMatch.betOption', 'betsForMatch.betDetails')->where('status', 'upcoming')->orderBy('match_time')->get();
        $siteSetting = SiteSetting::get()->first();
        $betSetting = BetSetting::get()->first();
        $banner = BannerImage::where('isEnabled', 1)->get();
        return view('upcoming', compact(['matches', 'siteSetting', 'betSetting','banner']));
    }

    public function getTransactionForm(){
    	return view('layouts.wallet.deposit');
    }

    public function transactions(){
        
        if(auth()->check()){
         return view('layouts.wallet.depositHistory');
        }else{
            return redirect()->back();
        }
    }
}
