<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_options',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string("name");
            $table->timestamps();

        });

        Schema::create('auto_main_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->timestamps();
        });

        Schema::create('auto_option_details', function(Blueprint $table){
            $table->bigIncrements("id");
            $table->string("name")->unique();
            $table->string("value")->nullable();
            $table->timestamps();

        });

        // Pivot tables

        Schema::create('auto_option_main_option',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger("auto_option_id");
            $table->unsignedBigInteger("auto_main_option_id");

            $table->foreign("auto_option_id","auto_option_foreign")->references("id")->on("auto_options")->onDelete("cascade");
            $table->foreign("auto_main_option_id","auto_main_option_foreign")->references("id")->on("auto_main_options")->onDelete("cascade");
        });

        Schema::create('main_option_option_detail',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger("auto_main_option_id");
            $table->unsignedBigInteger("auto_option_detail_id");

            $table->foreign("auto_main_option_id","auto_main_option_foreign_key")->references("id")->on("auto_main_options")->onDelete("cascade");
            $table->foreign("auto_option_detail_id","auto_option_detail_foreign")->references("id")->on("auto_option_details")->onDelete("cascade");
        });




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("auto_option_main_option",function(Blueprint $table){
            $table->dropForeign(["auto_option_foreign", "auto_main_option_foreign"]);
        });
        Schema::table("main_option_option_detail",function(Blueprint $table){
            $table->dropForeign(["auto_main_option_foreign_key", "auto_option_detail_foreign"]);
        });

        Schema::dropIfExists('main_option_option_detail');
        Schema::dropIfExists('auto_option_main_option');
        Schema::dropIfExists('auto_option_details');
        Schema::dropIfExists('auto_main_options');
        Schema::dropIfExists('auto_options');
    }
}
