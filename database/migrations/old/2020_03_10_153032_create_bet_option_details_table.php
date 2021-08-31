<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBetOptionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bet_option_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name")->nullable();
            $table->unsignedDecimal("value")->nullable();
            $table->unsignedInteger("bets_for_match_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bet_option_details');
    }
}
