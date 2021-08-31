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

Route::group(["namespace" => "API"],function(){
    Route::get('/matches','MatchController@getMatches')->name('api.matches');

    Route::get('/registration/essential',function(){
        $clubs = Club::get();
        return response()->json($clubs);
    });

    Route::post('/login','AuthenticationController@login');
    Route::post('/registration','AuthenticationController@register');

    Route::group(['middleware' => 'auth:api'],function(){
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
        Route::get('/transactions/{type}',"AccountController@getTransactions");

        // bet history
        Route::get('/bet/history',"AccountController@betHistory");
        
    });
});


