<?php

namespace App\Http\Controllers;

use App\TrackActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrackActivityController extends Controller
{
    public function index($day){
        $today = Carbon::now()->format('d');
        if (($today - $day) == 1){
            $activities = TrackActivity::latest()->paginate(5);
            return view('admin.activity.index',compact('activities'));
        }
        abort(503);
    }
}
