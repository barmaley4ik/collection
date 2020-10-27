<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->jsonb('name');
            $table->jsonb('social')->nullable();
            $table->string('logo', 100)->nullable();
            $table->string('footer_logo', 100)->nullable();
            $table->string('footer_logo_second', 100)->nullable();
            $table->string('favicon', 100)->nullable();
            $table->string('google_maps_api', 100)->nullable();
            $table->string('google_analytics', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }       
}
