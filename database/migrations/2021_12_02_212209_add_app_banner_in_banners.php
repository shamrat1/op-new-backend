<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAppBannerInBanners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('banner_images', function (Blueprint $table) {
        //     $table->boolean("is_app_download_banner")->default(0);
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('banner_images', function (Blueprint $table) {
        //     $table->dropColumn("is_app_download_banner");
        // });
    }
}
