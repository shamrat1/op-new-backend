<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Match;
use App\Transaction;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();
        $matches = Match::with('bids')->whereIn('status',['live','upcoming', 'pending'])->orderBy('match_time','desc')->get();
        return view('dashboard.index')->with([
            "users" => $users,
            "matches" => $matches
        ]);
    }
}
