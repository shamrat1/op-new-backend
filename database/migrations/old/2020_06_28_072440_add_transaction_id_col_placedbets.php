<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransactionIdColPlacedbets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('placed_bets', function (Blueprint $table) {
            $table->bigInteger('transaction_id')->unsigned()->nullable()->after('match_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('placed_bets', function (Blueprint $table) {
            //
        });
    }
}
