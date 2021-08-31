<?php

namespace App\Http\Controllers;

use App\Credit;
use App\User;
use App\Http\Traits\UserTransactions;
use App\Http\Traits\UserCredit;
use App\PlacedBet;
use Illuminate\Http\Request;
use App\Transaction;
use App\SiteSetting;
use App\Rules\ValidAmount;

class TransactionController extends Controller
{
    use UserTransactions;
    use UserCredit;
    /*
     * Transaction Request will hold
     *
     * 1. user id
     * 2. mobile no
     * 3. transaction id [ could be nullable, in case withdraw]
     * 4. type [ cash in, withdraw ]
     * 5. status [ approved, pending, canceled ]
     */
    

    function __contstruct(){
        $this->middleware('auth');
    }
    // Admin Area
    public function gifts(Request $request)
    {
        $gifts = Transaction::whereType('gift')
        ->when($request->username,function($q) use ($request){
            $q->whereHas('user',function($r)use ($request){
                $r->where('username', 'LIKE', '%' . $request->username . '%');
            });
		})
		->when($request->from,function($q) use ($request){
			$q->whereDate('created_at', '>=', $request->from);
		})
		->when($request->amount, function($q) use ($request){
			$q->where('amount','>=',$request->amount);
		})
		->when($request->to,function($q) use ($request){
			$q->whereDate('created_at', '<=', $request->to);
        })
        ->with('user:id,username')
        ->orderBy('id','desc')
        ->paginate(20)
        ->appends([
            'username' => request('username'),
            'to'=>request('to'),
            'amount'=>request('amount'),
            'from' => request('from'),
            ]);

        return view('admin.gift.index',compact('gifts'));
    }

    public function allDeposits(Request $request){

        $deposits = Transaction::whereType('deposit')
        ->when($request->username,function($q) use ($request){
            $q->whereHas('user',function($r)use ($request){
                $r->where('username', 'LIKE', '%' . $request->username . '%');
            });
		})
		->when($request->created_at,function($q) use ($request){
			$q->whereDate('created_at', '>=', $request->created_at);
		})
		->when($request->credit, function($q) use ($request){
			$q->where('amount','>=',$request->credit);
		})
		->when($request->to,function($q) use ($request){
			$q->where('backend_mobile', $request->to);
        })
        ->when($request->status,function($q) use ($request){
			$q->where('status', $request->status);
		})
        ->orderBy('id','desc')->paginate(20)
        ->appends([
            'username' => request('username'),
            'to'=>request('to'),
            'amount'=>request('amount'),
            'created_at' => request('created_at'),
            'status'=>request('status')]);

        $deposit = Transaction::where('type','deposit')->where('status','approved')->sum('amount');
        $withdraw = Transaction::where('type','withdraw')->where('status','approved')->sum('amount');
        $balance = $deposit - $withdraw;
        return view('admin.deposit.index',compact(['deposits','balance']));
    }

    public function updateDeposits(Request $request,$id){
        
        $this->validate($request,[
            "status" => "required|string"
        ]);
        
        $transaction = Transaction::find($id);
        $transaction->status = $request->input('status');

        $user = User::find($transaction->user_id);
        if($request->input('status') == "approved"){
            if(empty($user->credit)){
                //create credit
                Credit::create([
                    "user_id" => $user->id,
                    "amount" => $transaction->amount
                ]);

            }else{
                // update credit
                $credit = Credit::where('user_id',$user->id)->first();
                $credit->amount = $credit->amount + $transaction->amount;
                $credit->update();
            }
        }
        $transaction->update();
        alertify("Deposit is accepted.");
        return redirect()->back();
    }

    public function allWithdraws(Request $request){
        // dd($request->all());
        $withdraws = Transaction::whereType('withdraw')
        ->when($request->username,function($q) use ($request){
            $q->whereHas('user',function($r)use ($request){
                $r->where('username', 'LIKE', '%' . $request->username . '%');
            });
		})
		->when($request->requested_at,function($q) use ($request){
			$q->whereDate('created_at', '>=', $request->requested_at);
		})
		->when($request->credit, function($q) use ($request){
			$q->where('amount','>=',$request->credit);
		})
		->when($request->to,function($q) use ($request){
			$q->where('backend_mobile', $request->to);
        })
        ->when($request->status,function($q) use ($request){
			$q->where('status', $request->status);
		})
        ->orderBy('id','desc')->paginate(50)
        ->appends([
            'username' => request('username'),
            'to' => request('to'),
            'amount' => request('amount'),
            'requested_at' => request('requested_at'),
            'status' => request('status')]);

        $deposit = Transaction::where('type','deposit')->where('status','approved')->sum('amount');
        $withdraw = Transaction::where('type','withdraw')->where('status','approved')->sum('amount');
        $balance = $deposit - $withdraw;
        return view('admin.withdraw.index',compact(['withdraws','balance']));
    }

    public function getWithdrawEditForm($id){
        $data = Transaction::find($id);
        return view('admin.withdraw.edit')->with('data',$data);
    }

    public function updateWithdraw(Request $request){
        // dd($request->all());
        $id = $request->id;
        if($request->has('status') && $request->status != "approved"){
            $this->validate($request,[
                "status" => "required|string"
            ]);
            if($request->status == "canceled"){
                $this->refundTansaction($id);
            }else{
                Transaction::find($id)->update([
                    "status" => $request->input('status')
                ]);
            }
            alertify("status updated");
            return redirect()->route('withdraw.index');
        }

        $this->validate($request,[
            'backend_number' => 'required|numeric',
        ]);

        Transaction::find($id)->update([
            "backend_mobile" => $request->input('backend_number'),
            'status' => "approved"
        ]);

        alertify()->success("Withdraw request approved");
        return redirect()->route('withdraw.index');
        
    }
    // Admin Area End
    protected function refundTansaction($id){

        $transaction = Transaction::find($id);
        $transaction->status = "refunded";

        $credit = Credit::where('user_id', $transaction->user_id)->first();
        $credit->amount += $transaction->amount;

        $transaction->update();
        $credit->update();
    }
    public function refund(Request $request){
        // dd($request->all());
        if ($request->has('id')) {
            
            $transaction = Transaction::find($request->id);
            
            if ($transaction->user_id == auth()->user()->id && $transaction->status == "pending" && $transaction->type == "withdraw") {
                $transaction->status = "refunded";

                $credit = Credit::where('user_id', $transaction->user_id)->first();
                $credit->amount += $transaction->amount;

                $transaction->update();
                $credit->update();
            }else{
                dd('error');
            }
        }
        if($request->has('placed_bet_id')){
            $placedBet = PlacedBet::find($request->input('placed_bet_id'));
            $transaction = Transaction::find($placedBet->transaction_id);
            $transaction->status = "refunded";

            $credit = Credit::where('user_id', $transaction->user_id)->first();
            $credit->amount += $transaction->amount;

            $transaction->update();
            $credit->update();
            $placedBet->delete();
        }

        alertify()->success('Refund Transfer Successful.');
        return redirect()->back();
    }
 }
