<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BetsForMatch;

class BetOptionDetailsController extends Controller
{
    public function store(Request $request){
    	BetsForMatch::create($request->all());
    	return redirect()->back()->with("success","Bet Option added for this match.");
    }
}
