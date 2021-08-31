<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
class ReportController extends Controller
{
    public function userView()
    {
        return view('admin.reports.user');
    }

    public function filterUserData(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|exists:users,username'
        ]);
        $user = User::where('username',$request->username)->with('transactions','credit','placedBets','placedBets.match','placedBets.betDetail', 'placedBets.betDetail.betsForMatch', 'placedBets.betDetail.betsForMatch.betOption')->first();
        return view('admin.reports.user',compact('user'));
    }

    public function betView()
    {
        // return view('admin.reports.bet');
        return $this->userView();
    }

    public function transactionView()
    {
        return view('admin.reports.transaction');
    }

    public function filterTransactionData(Request $request)
    {
        $validated = $this->validate($request,[
            'from' => 'required|date',
            'till' => 'nullable|date',
            'type' => 'required|string',
        ]);
        
        if ($request->till == null) {
            $validated['till'] = Carbon::now()->format('Y-m-d');
        }
        if ($validated['type'] == "all") {
            $transactions = Transaction::whereStatus('approved')->whereBetween('created_at',[$validated['from'],$validated['till']])->with(['user'])->get(['amount','created_at','type','mobile','backend_mobile', 'user_id']);
        }else{
            $transactions = Transaction::whereStatus('approved')->whereBetween('created_at', [$validated['from'], $validated['till']])->whereType($validated['type'])->with(['user'])->get(['amount', 'created_at', 'type', 'mobile', 'backend_mobile','user_id']);
        }
        // dd($validated,$transactions);
        return view('admin.reports.transaction',compact('transactions','validated'));
    }
}
