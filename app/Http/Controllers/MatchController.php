<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use App\Tournament;
use App\BetOption;
use App\BetOptionDetail;
use App\BetsForMatch;
use App\Http\Traits\AdminAlertify;
use App\Http\Traits\BetValueSetter;
use DB;
use Exception;

class MatchController extends Controller
{
    use AdminAlertify, BetValueSetter;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $matches = Match::with('tournament','bids')->withCount('bids')->orderBy('id','desc')->paginate(20);
        return view("admin.match.index")->with('matches',$matches);
    }

    public function import($id)
    {
        $json = json_decode(file_get_contents('https://worldbet365.co.uk/api/someBet/match_info/'.$id));
        // return response()->json();
        // dd($json);
        if($json->status == 'success'){
            $tournament = Tournament::updateOrCreate([
                'name' => $json->data->tournament->name,
            ],[
                'created_at' => $json->data->tournament->created_at,
                'description' => $json->data->tournament->description,
                'type' => $json->data->tournament->type
            ]);
            $match = Match::updateOrCreate([
                'tournament_id' => $tournament->id,
                'name' => $json->data->name,
                'match_time' => $json->data->match_time,
                'tournament_match_no' => $json->data->tournament_match_no,
                'unique_id' => $json->data->name.'-'.$json->data->match_time,
            ],[
                'status' => 'draft',
                'score' => $json->data->score,
                'team1' => $json->data->team1,
                'team2' => $json->data->team2,
                'sport_type' => $json->data->sport_type,
            ]);
            foreach($json->data->bets_for_match as $item){
                $option = BetOption::updateOrCreate([
                    'name' => $item->bet_option->name,
                ],[
                    'description' => $item->bet_option->description,
                    'type' => $item->bet_option->type,
                    'isMultipleSupported' => $item->bet_option->isMultipleSupported,
                ]);
                $betsForMatch = BetsForMatch::updateOrCreate([
                    'match_id' => $match->id,
                    'bet_option_id' => $option->id,
                ],[
                    'correctBet' => null,
                    'isLive' => $item->isLive,
                    'score' => $item->score,
                    'isResultPublished' => false,
                ]);
                foreach($item->bet_details as $detail){
                    $newDetail = BetOptionDetail::updateOrCreate([
                        'name' => $detail->name,
                        'bets_for_match_id' => $betsForMatch->id,
                    ],[
                        'value' => $this->getBetValue(floatval($detail->value)),
                    ]);
                }
                // dump($option,$betsForMatch);
            }
            return redirect()->route('match.index');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tournaments = Tournament::all();
        return view("admin.match.create")->with('tournaments',$tournaments);
    }

    public function getImports()
    {
        return view("admin.match.import");
    }

    public function refreshImports(Request $request)
    {
        $data = json_decode(file_get_contents('https://worldbet365.co.uk/api/someBet/match_info_dashboard'));
        if($data->status == 'success'){
            try{
                DB::beginTransaction();
                foreach($data->data as $match){
                    // dd($match,$match->bets_for_match,count($match->bets_for_match),is_array($match->bets_for_match),is_object($match->bets_for_match));
                    $tournament = Tournament::updateOrCreate([
                        'name' => $match->tournament->name,
                    ],[
                        'created_at' => $match->tournament->created_at,
                        'description' => $match->tournament->description,
                        'type' => $match->tournament->type
                    ]);
                    $matchObj = Match::updateOrCreate([
                        'tournament_id' => $tournament->id,
                        'name' => $match->name,
                        'match_time' => $match->match_time,
                        'tournament_match_no' => $match->tournament_match_no,
                        'unique_id' => $match->name.'-'.$match->match_time,
                    ],[
                        'status' => $match->status,
                        'score' => $match->score,
                        'team1' => $match->team1,
                        'team2' => $match->team2,
                        'sport_type' => $match->sport_type,
                    ]);

                    foreach($match->bets_for_match as $key => $item){
                        
                        $option = BetOption::updateOrCreate([
                            'name' => $item->bet_option->name,
                        ],[
                            'description' => $item->bet_option->description,
                            'type' => $item->bet_option->type,
                            'isMultipleSupported' => $item->bet_option->isMultipleSupported,
                        ]);
                        $betsForMatch = BetsForMatch::updateOrCreate([
                            'match_id' => $matchObj->id,
                            'bet_option_id' => $option->id,
                        ],[
                            'correctBet' => $item->correctBet,
                            'isLive' => $item->isLive,
                            'score' => $item->score,
                            'isResultPublished' => $item->isResultPublished,
                        ]);
                        foreach($item->bet_details as $detail){
                            $newDetail = BetOptionDetail::updateOrCreate([
                                'name' => $detail->name,
                                'bets_for_match_id' => $betsForMatch->id,
                            ],[
                                'value' => $this->getBetValue(floatval($detail->value)),
                            ]);
                        }
                        // dump($option,$betsForMatch);
                    }
                }
                DB::commit();
            }catch (Exception $e){
                DB::rollBack();
                dd($e);
            }
            if($request->has('json')){
                $matches = Match::with('bids')->whereIn('status',['live','upcoming'])->orderBy('created_at','desc')->get();
                return response()->json([
                    'matches' => $matches
                ]);
            }
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Match::create($request->all());
        return redirect()->route('match.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $tournaments = Tournament::select(["id","name"])->get();
        $match = Match::with(
            [
                "bids" => function($q){
                    $q->latest();
                },
                'bids.betDetail:id,bets_for_match_id',
                'bids.betDetail.betsForMatch:id,bet_option_id',
                'bids.betDetail.betsForMatch.betOption:id,name',
                'bids.user:id,username',
                'BetsForMatch','tournament:id,name'
            ]
        )->find($id);
        $betOptions = BetOption::select(["id","name"])->get();
        $betOptionsSelected = BetsForMatch::where('match_id','=',$id)->with(['betOption', 'betDetails'])->get();
        // dd($betOptionsSelected->pluck("correctBet"));
        return view('admin.match.show')->with([
            'match' => $match,
            'betOptions' => $betOptions,
            'betOptionsSelected' => $betOptionsSelected,
            'tournaments' => $tournaments
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        Match::find($id)->update($request->all());
        $this->showSuccessAlert("Match information updated successfully.");
        return redirect()->back();
    }

    public function score(Request $request,$id)
    {
        Match::find($id)->update([
            'score' => $request->score
        ]);
        $this->showSuccessAlert("Match Score updated successfully.");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function turnOffScore($id)
    {
        $data = BetsForMatch::where('match_id',$id)->update(['score'=> 0]);
        return redirect()->back()->with('success','All Scores are turned off.');
    }
    public function turnOnScore($id)
    {
        $data = BetsForMatch::where('match_id', $id)->update(['score' => 1]);
        return redirect()->back()->with('success', 'All Scores are turned off.');
    }
    
}
