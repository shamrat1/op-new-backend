<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('track_activities', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->string('author')->nullable();
        //     $table->string('author_roles')->nullable();
        //     $table->string('model')->nullable();
        //     $table->longText('before')->nullable();
        //     $table->longText('after')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('track_activities');
    }
}
