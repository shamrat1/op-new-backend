<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /*
     * Transaction Request will hold
     *
     * 1. user id
     * 2. mobile no
     * 3. transaction id [ could be nullable, in case withdraw]
     * 4. type [ cash in, withdraw ]
     * 5. status [ approved, pending, canceled ]
     */
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('mobile',20);
            $table->string('txn_id')->nullable();
            $table->string('type',20);
            $table->string('status',20)->default('pending');
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
        Schema::dropIfExists('transactions');
    }
}
