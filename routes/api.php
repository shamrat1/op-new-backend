<?php

use App\Club;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: GET,HEAD,POST");

Route::group(["namespace" => "API","middleware" => "cors"],function(){
    Route::get('/matches','MatchController@getMatches')->name('api.matches');
    Route::get('/settings/xxxyyyzzz','AccountController@getSettings');

    Route::get('/registration/essential',function(){
        $clubs = Club::get();
        return response()->json($clubs);
    });

    Route::post('/login','AuthenticationController@login');
    Route::post('/registration','AuthenticationController@register');

    Route::group(['middleware' => 'auth:api'],function(){

        // offers
        Route::get('/offers',"AccountController@getOffers");
        // game history place
        Route::post("/place/game/history",'GameHistoryController@placeHistory');

        // game history place verify
        Route::post("/place/game/history/{id}",'GameHistoryController@verifyHistory');

        // place bet
        Route::post('/place/bet','UserBetController@userNewBet');

        // new deposit
        Route::post('/deposit',"AccountController@storeDeposit");

        // new withdraw
        Route::post('/withdraw',"AccountController@storeWithdraw");

        // update userinfo
        Route::post('/user/info',"AccountController@updateUserInfo");

        // user info with credit
        Route::get('/user/info',"AccountController@userInfo");

        // user transactions
        Route::get('/transactions/{type?}',"AccountController@getTransactions");

        // bet history
        Route::get('/bet/history',"AccountController@betHistory");
        
    });

    Route::group(['prefix' => 'game'],function(){
        Route::group(['prefix' => 'coin-toss'],function(){
            Route::get("/start","CoinGameController@start");
        });
    });
});


