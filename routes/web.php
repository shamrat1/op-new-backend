<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Jobs\SendMail;
use App\PlacedBet;
use App\Setting;

/**
 */
Route::get("/test/option","AutoOptionController@index");
Route::get("/auto/login",function (){
	Auth::loginUsingId(1,true);
});

View::composer(['layouts.master', 'layouts.master-auth'], function ($view) {
	if (auth()->check()) {
		$total = empty(auth()->user()->credit) ? 0 : auth()->user()->credit->amount;
		$credit = $total > 0 ? $total : 0;
		$view->with('credit', $credit);
		
	}

});

// Route::get('/',function(){
//     return view('error.error');
// });

// for viewing everything
Route::middleware('role:Admin,Admin1,Editor')->prefix('admin')->group(function (){

	// Auto Options
	Route::group(["prefix" => "auto-option","as" => "auto-option."],function(){

		Route::post("/main","AutoOptionController@storeOption")->name("main");
		Route::post("/secondary","AutoOptionController@storeOptionSecondary")->name("secondary");
		Route::post("/third","AutoOptionController@storeOptionThird")->name("third");
		
		Route::get("/link/option/{id}","AutoOptionController@getLinkOptionView")->name("link.show");
		Route::post("/link/option/{id}","AutoOptionController@getLinkOptionStore")->name("link.store");

		Route::get("/link/secondary-option/{id}","AutoOptionController@getLinkSecondaryOptionView")->name("link.secondary.show");
		Route::post("/link/secondary-option/{id}","AutoOptionController@getLinkSecondaryOptionStore")->name("link.secondary.store");

		Route::get("/","AutoOptionController@index")->name("index");
		Route::get("/create","AutoOptionController@create")->name("create");
		Route::post("/","AutoOptionController@store")->name("store");
		Route::put("/update/{id}","AutoOptionController@update")->name("update");
		Route::get("/edit/{id}","AutoOptionController@edit")->name("edit");
		Route::delete("/{id}","AutoOptionController@delete")->name("delete");
	});

	Route::get('/', 'HomeController@index')->name('admin');

	//tournaments
	Route::get('/tournaments', 'TournamentController@index')->name('tournaments.index');

	//matches
	Route::get('/match', 'MatchController@index')->name('match.index');

	//bets
	Route::get('/bet', 'BetOptionController@index')->name('bet.index');

	//admin banner routes
	Route::get('/banners','BannerImageController@addbanner')->name('banners.addbanner');
	Route::post('/banners','BannerImageController@store')->name('banners.store');
	
	// settings
	Route::get("/setting","SettingController@index")->name("setting.index");
	Route::post("/setting/store","SettingController@store")->name("setting.store");
	Route::delete("/setting/{key}","SettingController@delete")->name("setting.delete");

	//site settings
	Route::get('/setting', 'SiteSettingController@index')->name('setting');

});
Route::middleware('role:Admin,Admin1')->prefix('admin')->group(function (){


	//Deposits
	Route::get('/deposits', 'TransactionController@allDeposits')->name('deposit.index');
	Route::put('/deposits/{id}', 'TransactionController@updateDeposits')->name('deposit.update');
	Route::get('/deposits/cancel/','DepositController@bulkCancel')->name('deposit.cancel.bulk');

	//Gifts
	Route::get('/gifts','TransactionController@gifts')->name('gift.index');
	// Withdraw Routes
	Route::get('/withdraws', 'TransactionController@allWithdraws')->name('withdraw.index');
	Route::get('/withdraws/{id}/edit', 'TransactionController@getWithdrawEditForm')->name('withdraw.edit');
	Route::post('/withdraws', 'TransactionController@updateWithdraw')->name('withdraw.update');

	//clubs
	Route::get('/club', 'ClubController@index')->name('club.index');

	//users
	Route::get('/user', 'UserController@index')->name('user.index');
	Route::get('/user/{id}', 'UserController@show')->name('user.show');

	Route::get('/banner/{id}/status','BannerImageController@changeStatus')->name('banner.status');

});
Route::middleware('role:Admin,Editor,Admin1')->prefix('admin')->group(function () {
	// Games
	Route::get('game/histories',"GameHistoryController@index")->name("game.index");
	// Tournament Routes
	Route::resource('/tournaments', 'TournamentController')->except('index','create', 'show', 'edit');
	// Match Routes
	Route::resource('/match', 'MatchController')->except(['index','edit']);
	Route::post('/match/{id}/score','MatchController@score')->name('match.score.update');
	Route::get('/match/{id}/score/off','MatchController@turnOffScore')->name('match.score.off');
	Route::get('/match/{id}/score/on', 'MatchController@turnOnScore')->name('match.score.on');

	Route::get('match/import/{id}','MatchController@import')->name('match.import');
	Route::get('matches/import','MatchController@getImports')->name('match.import.index');
	Route::get('matches/import/refresh','MatchController@refreshImports')->name('match.import.refresh');

	// Bet Control Routes
	Route::post('/match/bets', 'BetsController@bets')->name('match.bets');
	Route::post('/match/bets/correct/{id}', 'BetsController@registerCorrectBet')->name('bet.correct');
	Route::post('/match/bets/result/{id}', 'BetsController@publishBetResult')->name('bet.publish-result');
	Route::post('/match/bets/no/result/{id}', 'BetsController@publishNoResult')->name('bet.publish.noresult');
	Route::post('/match/bets/status/{id}', 'BetsController@changeBetStatus')->name('bet.status');
	Route::post('/match/bets/score/{id}', 'BetsController@betScoreSwitch')->name('bet.score');

	// Bet Option Routes
	Route::resource('/bet', 'BetOptionController')->except('index','show', 'edit');
	Route::post('/bet/details', 'BetOptionDetailsController@store')->name('details.store');

	// Site Setting
	Route::post('/setting', 'SiteSettingController@createOrPatch')->name('setting.createOrPatch');

	// Payment Setting
	Route::put('/setting/payment','SiteSettingController@paymentCreateOrPatch')->name('setting.payment');

	// Bet amount Setting
	Route::put('/setting/bet','SiteSettingController@betCreateOrPatch')->name('setting.bet');

});

Route::middleware('role:Admin')->prefix('admin')->group(function(){
	Route::post('user/{id}/role/', 'UserController@role')->name('user.role');

	Route::get('/tracker/{day}','TrackActivityController@index');

});

Route::middleware('role:Admin,Admin1')->prefix('admin')->group(function () {

	// Club Routes
	Route::post('/club','ClubController@store')->name('club.store');

	Route::get('/banner/{id}/delete','BannerImageController@delete')->name('banner.delete');

	// Reports
	Route::get('/report/users','ReportController@userView')->name('report.user');
	Route::post('/report/users/','ReportController@filterUserData')->name('report.user.filter');

	Route::get('/report/bet', 'ReportController@betView')->name('report.bet');
	Route::post('/report/bet', 'ReportController@filterBetData')->name('report.bet.filter');

	Route::get('/report/transaction', 'ReportController@transactionView')->name('report.transaction');
	Route::post('/report/transaction', 'ReportController@filterTransactionData')->name('report.transaction.filter');

	// User Routes
	Route::resource('/user', 'UserController')->except('index','show');
	Route::put('/user/password/{id}','UserController@updatePassword')->name('user.password');
	Route::put('/user/{id}/credit', 'UserController@updateCredit')->name('credit.update');



	Route::get('/send/mails', function () {
		Artisan::call('queue:work', ['--stop-when-empty' => true]);
	})->name('send.mail');

	Route::get('/send/mails/retry', function () {
		Artisan::call('queue:retry');
	})->name('send.failed');

});
Route::middleware(['role:Club Owner'])->group(function(){
	Route::get('/club/statement','ClubController@getClubStatement')->name('club.statement');
	Route::get('/followers/histoy/{username}','ClubController@getFollowerHistory')->name('club.follower.history');
});

Route::middleware(['auth'])->group(function () {

	Route::get('/transactions/create', 'TransactionController@getTransactionForm')->name('transactions.create');
	Route::post('/transactions', 'TransactionController@transactionStore')->name('transactions.store');
	Route::get('/transactions', 'TransactionController@transactions')->name('transactions.all');

	Route::get('/withdraws/create', 'TransactionController@getWithdrawForm')->name('withdraw.create');
	Route::post('/withdraws', 'TransactionController@withdrawStore')->name('withdraw.store');
	Route::get('/withdraws', 'TransactionController@withdraws')->name('withdraw.all');

	Route::get('/transfer/coins','TransactionController@getCoinTransferForm')->name('coin-transfer.create');
	Route::post('/transfer/coins','TransactionController@coinTransfer')->name('coin-transfer.store');

	Route::post('/transactions/refund','TransactionController@refund')->name('transactions.refund');
	Route::post('/place/bet','PlacedBetController@userNewBet')->name('place.bet');

	Route::group(['prefix' => 'user'], function () {
		Route::get('/profile','PagesController@getProfile')->name('profile');
		Route::get('/profile/edit','PagesController@getEditProfileForm')->name('profile.edit');
		Route::post('/profile/update/{id}','PagesController@updateProfile')->name('profile.update');
		Route::get('/club/change','PagesController@getClubChangeForm')->name('club.change');
		Route::post('/club/change', 'PagesController@updateClub')->name('club.update');
		Route::get('/followers','PagesController@getFollowers')->name('followers');
		Route::get('/bet/history','PagesController@getBetHistory')->name('bet.history');
		Route::get('/statement','PagesController@getStatement')->name('statement');
		Route::get('/password/change','PagesController@getPasswordChangeForm')->name('password.change');
		Route::post('/password/change','PagesController@updatePassword')->name('user.password.update');
	});


});

if(config('app.env') == 'local'){

	Route::get('/migrate', function () {
		Artisan::call('migrate');
	});

	Route::get('/migrate/refresh', function () {
		Artisan::call('migrate:refresh');
	});

	Route::get('/db/seed', function () {
		Artisan::call('db:seed');
	});




	Route::get('/send', function () {
		// Run Email Jobs
		$data = [
			'name' => " Yasin Shamrat",
			'email' => "yshamrat@gmail.com",
			'amount' => "1000",
			'sponser' => "sponser@gmail.com",
			'sponserAmount' => "100",
			'club' => "Gucci Gang",
			'clubAmount' => "200",
			'won_at' => "2020-05-15 10:54:29"
		];
		SendMail::dispatch($data);
	});
}
// Route::get('/env', function () {
// 	echo config('app.env');
// });

// Route::get('/roles',function(){
// 	dd(Auth::user(),Auth::user()->roles);
// });


Auth::routes(['verify' => true]);
Route::get('/register/refer', 'Auth\RegisterController@showRegistrationForm')->name('register.refer');

Route::get('/', 'PagesController@index')->name('index');
Route::get('/upcoming', 'PagesController@upcomingMatches')->name('upcoming.matches');

Route::get('/migrate/db',function(){
	$placedBets = PlacedBet::get();
	// dd($placedBets);

	$i = 0;
	foreach($placedBets as $bid){
		$bidOptionDetail = DB::table('bet_option_details')->find($bid->bet_option_detail_id);
		$betsForMatch = DB::table('bets_for_matches')->find($bidOptionDetail->bets_for_match_id);
		// $i++;
		// if($i == 400){
		// 	dd($betsForMatch,$bid);
		// }

		if($betsForMatch->isResultPublished){
			if($betsForMatch->correctBet != null){
				if($betsForMatch->correctBet == $bid->bet_option_detail_id){
					$bid->update(["isWin" => 1]);
				}else{
					$bid->update(["isWin" => 0]);
				}

			}
		}
	}
});

Route::get('/agent',function (){
   dd(\Jenssegers\Agent\Facades\Agent::isMobile());
});

