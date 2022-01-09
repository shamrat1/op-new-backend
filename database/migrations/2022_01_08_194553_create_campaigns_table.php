<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('effective_on')->nullable();
            $table->enum('status',['draft','live'])->default('draft');
            $table->unsignedDecimal('min_amount');
            $table->unsignedDecimal('max_amount');
            $table->unsignedDecimal('reward_amount')->default('0.0');
            $table->enum('amount_type',['percent','fixed'])->default('fixed');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
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
        Schema::dropIfExists('campaigns');
    }
}
