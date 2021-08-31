<?php

namespace App\Http\Controllers;

use App\Transaction;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function bulkCancel()
    {
        $oneHrBack = Carbon::now()->subHour();
        try{
            DB::beginTransaction();
            $cancellableDeposits = Transaction::where('type','deposit')
            ->where('status','pending')
            ->where('created_at','>=',$oneHrBack)
            ->update([
                'status' => 'canceled'
            ]);
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->back();
    }
}
