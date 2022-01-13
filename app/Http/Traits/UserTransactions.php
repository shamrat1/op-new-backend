<?php

namespace App\Http\Traits;

use App\BetSetting;
use App\Campaign;
use App\Credit;
use App\User;
use Illuminate\Http\Request;
use App\Transaction;
use App\Rules\ValidAmount;
use App\SiteSetting;
use App\Http\Traits\UserCredit;
use App\PaymentSetting;
use App\Setting;

/** 
 * User Transaction Trait
 */
trait UserTransactions
{

     use UserCredit;

     public function getTransactionForm()
     {
          $setting = SiteSetting::get()->first();
          $campaigns = Campaign::where('status','live')->get();
          $settings = Setting::get();
          // if($setting->isDepositable){
               $backendMobile = $setting->backend_number;
               $paymentSetting = PaymentSetting::first();
               return view('layouts.wallet.deposit', compact(
                    'backendMobile',
                    'paymentSetting',
                    'campaigns',
                    'settings'
               ));
          // }
          // return redirect()->back()->with('message','Deposit requests are not available now. Try Again after some time.');

          
     }

     public function transactionStore(Request $request)
     {
          $this->validate($request, [
               "mobile" => "required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11",
               "password" => "required|current_password",
               // "txn_id" => "nullable",
               "amount" => "required|numeric",
               "backend_mobile" => "required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10"
          ]);

          Transaction::create([
               'user_id' => auth()->user()->id,
               'mobile' => $request->input('mobile'),
               'backend_mobile' => $request->input('backend_mobile'),
               // 'txn_id' => $request->input('txn_id'),
               'type' => 'deposit',
               'payment_method' => $request->input('payment_method'),
               'amount' => $request->input('amount'),
               'status' => 'pending'
          ]);

          alertify()->success('Deposit request submitted successfully. Awaiting for admin approval.');
          return redirect()->route('transactions.all');
     }

     public function transactions()
     {
          $deposits = Transaction::where('user_id', auth()->user()->id)->where('type', 'deposit')->orderBy('id', 'desc')->get();
          return view('layouts.wallet.depositHistory', compact('deposits'));
     }
     public function getWithdrawForm()
     {
          $settings = SiteSetting::first();
          if($settings->isWithdrawable == true)
               return view('layouts.wallet.withdraw')->with('userCredit', $this->getCredit(auth()->user()->id))->withSetting($settings);

          return redirect()->back()->with('message','Withdraw requests are not available now. Try Again after some time.');
     }

     public function withdrawStore(Request $request)
     {
          // dd($request->all());
          if(auth()->user()->hasRole('CLub Owner')){
               $this->validate($request, [
                    "amount" => "required|numeric",
                    "password" => "required|current_password"
               ]);
               $user = auth()->user();
               // dd($user->credit->amount);
               if ($request->amount <= $user->credit->amount - 20 && $user->mobile != null) {
                    Transaction::create([
                         "user_id" => $user->id,
                         "type" => "withdraw",
                         "mobile" => 0,
                         "amount" => $request->input('amount'),
                         'txn_id' => 'ATWB-' . $user->credit->amount
                    ]);
                    $credit = Credit::where('user_id', $user->id)->first();
                    $credit->amount = $credit->amount - $request->input('amount');
                    $credit->update();
     
                    alertify()->success('Withdraw request submitted. Waiting for approval.');
                    return redirect()->route('withdraw.all');
               }
          }
          $this->validate($request, [
               "mobile" => "required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11",
               "amount" => "required|numeric",
               "password" => "required|current_password",
               "payment_type" => "nullable|string"
          ]);
          $user = auth()->user();
          // dd($user->credit->amount);
          if ($request->amount <= $user->credit->amount - 20 && $user->mobile != null) {
               Transaction::create([
                    "user_id" => $user->id,
                    "type" => "withdraw",
                    "mobile" => $request->input('mobile'),
                    "payment_type" => $request->input('payment_type'),
                    "payment_method" => $request->input('payment_method'),
                    "amount" => $request->input('amount'),
                    'txn_id' => 'ATWB-' . $user->credit->amount
               ]);
               $credit = Credit::where('user_id', $user->id)->first();
               $credit->amount = $credit->amount - $request->input('amount');
               $credit->update();

               alertify()->success('Withdraw request submitted. Waiting for approval.');
               return redirect()->route('withdraw.all');
          }
          // alertify()->error('Amount Error');
          return redirect()->route('withdraw.create')->withErrors('Error Placing Request. Contact Admin.');
     }

     function withdraws()
     {
          $withdraws = Transaction::where('user_id', auth()->user()->id)->where('type', 'withdraw')->orderBy('id', 'desc')->get();
          return view('layouts.wallet.withdrawHistory', compact('withdraws'));
     }
     public function getCoinTransferForm()
     {
          $credit = $this->getCredit(auth()->user()->id);
          return view('layouts.wallet.coins-transfer', compact('credit'));
     }
     public function coinTransfer(Request $request)
     {
          $this->validate($request, [
               'amount' => ['required', new ValidAmount(20, $this->getCredit(auth()->user()->id) - 20)],
               'username' => 'required|exists:users,username',
               'password' => 'required|current_password'
          ]);
          $sender = auth()->user();
          $receiver = User::where('username', $request->username)->first();

          if ($sender->username != $receiver->username) {
               $senderCredit = Credit::where('user_id', $sender->id)->first();
               $receiverCredit = Credit::where('user_id', $receiver->id)->first();

               $transaction = new Transaction();
               $transaction->user_id = $sender->id;
               $transaction->amount = $request->amount;
               $transaction->mobile = 0;
               $transaction->type = 'gift';
               $transaction->payment_type = 'giftTo-' . $receiver->id;
               $transaction->status = 'approved';
               $transaction->save();

               $senderCredit->amount -= $request->amount;

               $transaction2 = new Transaction();
               $transaction2->user_id = $receiver->id;
               $transaction2->amount = $request->amount;
               $transaction2->mobile = 0;
               $transaction2->type = 'gift';
               $transaction2->payment_type = 'giftFrom-' . $sender->id;
               $transaction2->status = 'approved';
               $transaction2->save();

               $receiverCredit->amount += $request->amount;

               $senderCredit->update();
               $receiverCredit->update();

               return redirect()->back()->with('success', "Transfer Completed.");
          }
          return redirect()->back()->withErrors("Error Transfering. Contact Admin.");
     }
}
