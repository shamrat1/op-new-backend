<?php

namespace App\Http\Controllers;

use App\GameHistory;
use Illuminate\Http\Request;

class GameHistoryController extends Controller
{
    public function index(Request $request)
    {
        $history = GameHistory::with('user')->latest()->paginate(20);

        return view('admin.game-history.index',compact('history'));
    }
}
