<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\BetOptionDetail;
use App\BetsForMatch;
use App\Credit;
use App\PlacedBet;
use App\Transaction;
use Route;
use App\Http\Traits\BetCommission;
use Log;
use App\User;
use App\Jobs\SendMail;

class BetsController extends Controller
{
    use BetCommission;

    public function registerCorrectBet(Request $request,$id){
        // dd($request->all());
        $this->validate($request,[
            'correctBet' => 'required|numeric|exists:bet_option_details,id'
        ]);

        BetsForMatch::find($id)->update([
            'correctBet' => $request->input('correctBet')
        ]);

        alertify()->success("Correct Bet is Set.")->position('bottom right');
        return redirect()->back();
    }
    public function publishNoResult(Request $request,$id)
    {
        $this->validate($request, [
            'match_id' => 'required|exists:matches,id'
        ]);
        //will get bets for match id as $id
        $betForMatch = BetsForMatch::find($id);
        $betOptionDetailIds = $betForMatch->betDetails->pluck('id');
        $bids = PlacedBet::whereIn('bet_option_detail_id', $betOptionDetailIds)->get();
        if(count($bids) > 0){
            foreach ($bids as $bid) {
                $user = User::find($bid->user_id);
                $return = $bid->amount - round($bid->amount * (5 / 100));
                $credit = Credit::where('user_id', $user->id)->first();
                $credit->amount += $return;
                $credit->update();

                // add record in transaction table for user
                Transaction::create([
                    'user_id' => $user->id,
                    'type' => 'betRefund',
                    'amount' => $return,
                    'status' => "refunded",
                    'mobile' => 0
                ]);

                //find out if there is any sponser or club owner
                Log::channel('activity')->alert("User: $user->username is refunded an amount of $return for placing bet on $bid->bet_name.");
            }
            $betForMatch->isLive = false;
            $betForMatch->isResultPublished = true;
            $betForMatch->save();

            alertify()->success("Bet no result was published successfully. " . count($bids) . " users were refunded.")->position("bottom right");
            return redirect()->back();
        }
        $betForMatch->isLive = false;
        $betForMatch->isResultPublished = true;
        $betForMatch->save();
        $betName = $betForMatch->betOption->name;
        Log::Channel('activity')->alert("No one refunded for $betName");

        alertify()->success("Bet result was published successfully. No one refunded.")->position('bottom right');
        return redirect()->back();
    }

    public function publishBetResult(Request $request,$id)
    {
        
        $this->validate($request,[
            'match_id' => 'required|exists:matches,id'
        ]);

        //will get bets for match id as $id
        $betForMatch = BetsForMatch::find($id);

        // get correctbet from
        $winners = PlacedBet::where('match_id',$request->input('match_id'))->where('bet_option_detail_id',$betForMatch->correctBet)->get();
        
        // dd($winners);
        if(count($winners) > 0){
            foreach($winners as $winner){
                $user = User::find($winner->user_id);
                $reward = $winner->amount * $winner->bet_value;
                $sponserPercent = $this->commissionCalculation(1, $winner->amount);
                $clubPercent = $this->commissionCalculation(2, $winner->amount);
                $club = $user->club;
                
                $userCredit = Credit::where('user_id',$winner->user_id)->first();
                $userCredit->amount += round($reward);
                $userCredit->update();

                // add record in transaction table for user
                Transaction::create([
                    'user_id' => $user->id,
                    'type' => 'betWin',
                    'amount' => round($reward),
                    'status' => "approved",
                    'mobile' => 0
                ]);

                //find out if there is any sponser or club owner
                Log::channel('activity')->notice("User: $user->email is rewarded with $reward for placing bet on $winner->bet_name.");

                // if ($user->sponser_email != null){
                //     // give credit to sponser
                //     $this->sponserCommission($user->sponser_email,$sponserPercent);
                // }

                // if ($user->club_id != null){
                //     // give credit to club owner
                //     $this->clubCommission($club,$this->commissionCalculation(2,$reward));
                // }

                // Run Email Jobs
                // $data = [
                //     'name' => $user->name,
                //     'email' => $user->email,
                //     'amount' => $reward,
                //     'sponser' => $user->sponser_email,
                //     'sponserAmount' => $sponserPercent,
                //     'club' => $club->name,
                //     'clubAmount' => $clubPercent,
                //     'won_at' => $userCredit->updated_at
                // ];
                // SendMail::dispatch($data);
                
            }
            $betForMatch->isLive = false;
            $betForMatch->isResultPublished = true;
            $betForMatch->save();

            alertify()->success("Bet result was published successfully. " . count($winners) . " users were rewarded.")->position("bottom right");
            return redirect()->back();
        }

        $betForMatch->isLive = false;
        $betForMatch->isResultPublished = true;
        $betForMatch->save();
        $betName = $betForMatch->betOption->name;
        Log::Channel('activity')->alert("No one rewarded for $betName");

        alertify()->success("Bet result was published successfully. No one rewarded.")->position('bottom right');
        return redirect()->back();


        
    }

    public function changeBetStatus(Request $request,$id)
    {
        // dd($request->all());
        $betForMatch = BetsForMatch::find($id);
        $betForMatch->isLive = !$betForMatch->isLive;
        $betForMatch->update();

        alertify()->success("Bet Status is changed successfully.")->position('bottom right');
        return redirect()->back();
    }

    public function betScoreSwitch($id)
    {
        $betForMatch = BetsForMatch::find($id);
        $betForMatch->score = !$betForMatch->score;
        $betForMatch->update();

        alertify()->success("Bet Score status is changed successfully.")->position('bottom right');
        return redirect()->back();
    }


    public function bets(Request $request)
    {
        // dd($request->all());
        if (is_array($request->name)) {
            for ($i = 0; $i < count($request->name); $i++) {
                if (isset($request->details_id[$i])) {
                    $details = BetOptionDetail::find($request->details_id[$i]);
                    $details->name = $request->name[$i];
                    $details->value = $request->value[$i];
                    $details->update();
                } else {
                    if($request->name[$i] != null && $request->value[$i] != null){
                        $details = new BetOptionDetail();
                        $details->name = $request->name[$i];
                        $details->bets_for_match_id = $request->bets_for_matches_id;
                        $details->value = $request->value[$i];
                        $details->save();
                    }
                }
            }

            alertify()->success("Bets are changed successfully.")->position('bottom right');
            return redirect()->back();
        } else {
            if ($request->name != null && $request->value != null) {
                $details = new BetOptionDetail();
                $details->name = $request->name;
                $details->bets_for_match_id = $request->bets_for_matches_id;
                $details->value = $request->value;
                $details->save();
            }

            alertify()->success("Bet is added successfully.")->position('bottom right');
            return redirect()->back();
        }
    }

    public function betDetailDelete($id)
    {
        BetOptionDetail::find($id)->delete();
        alertify()->success("Bet is deleted successfully.")->position('bottom right');
        return redirect()->back();
    }
}
