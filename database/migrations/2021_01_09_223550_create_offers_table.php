<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('offers', function (Blueprint $table) {
        //     // $table->bigIncrements('id');
        //     // $table->enum('offer',['cashback','cash_reward','homecoming'])->default('cashback');
        //     // $table->enum('applies_on',['deposit','withdraw','onBet','onBetWin'])->default('deposit');
        //     // $table->decimal('amount')->default(0);
        //     // $table->decimal('valid_amount')->default(5000);
        //     // $table->dateTime('valid_from');
        //     // $table->dateTime('valid_till');
        //     // $table->boolean('isActive')->default(0);
        //     // $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
