<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFestivalsTable extends Migration
{
    public function up()
    {
        Schema::create('festivals', function (Blueprint $table) {
            $table->increments('id');
            $table->jsonb('name');
            $table->string('slug', 150)->unique();
            $table->jsonb('meta_title');
            $table->jsonb('meta_description')->nullable();
            $table->jsonb('sliders')->nullable();
            $table->jsonb('gallery')->nullable();
            $table->jsonb('adress')->nullable();
            $table->jsonb('supervisor_project')->nullable();
            $table->jsonb('supervisor_sponsors')->nullable();
            $table->jsonb('supervisor_members')->nullable();
            $table->jsonb('phones')->nullable();
            $table->string('video_url', 100)->nullable();
            $table->string('concert_ua_url', 100)->nullable();
            $table->string('google_map_coordinates', 100)->nullable();
            $table->boolean('is_default');
            $table->date('date_start');
            $table->date('date_end');
            $table->jsonb('city')->nullable(); 
            $table->jsonb('custom_text')->nullable(); 
            $table->boolean('status');   
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('festivals');
    }       
}