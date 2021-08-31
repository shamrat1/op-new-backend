<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBetOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bet_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->string("description")->nullable();
            $table->string("type")->nullable();
            $table->boolean("isMultipleSupported");
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
        Schema::dropIfExists('bet_options');
    }
}
