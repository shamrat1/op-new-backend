<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColBetsForMatches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bets_for_matches', function (Blueprint $table) {
            $table->bigInteger('correctBet')->after('bet_option_id')->unsigned()->nullable();
            $table->boolean('isLive')->after('correctBet')->default(0);
            $table->boolean('isResultPublished')->after('isLive')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bets_for_matches', function (Blueprint $table) {
            $table->dropColumn('isLive');
            $table->dropColumn('isResultPublished');
        });
    }
}
