 * <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacedBetsTable extends Migration
{
    /*
     * To place a bet user request will hold following data.
     * 1. user_id
     * 2. bets_for_match_id
     * 3. amount
     * 4. bet_name
     * 5. bet_value
     */
   
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placed_bets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('match_id')->unsigned();
            $table->bigInteger('bet_option_detail_id')->unsigned();
            $table->integer('amount')->unsigned();
            $table->string('bet_name');
            $table->float('bet_value')->unsigned();
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
        Schema::dropIfExists('placed_bets');
    }
}
