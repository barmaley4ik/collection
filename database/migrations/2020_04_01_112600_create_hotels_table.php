<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration
{
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->increments('id');
            $table->jsonb('header');
            $table->jsonb('hotel');
            $table->jsonb('meta_title');  
            $table->jsonb('meta_description')->nullable();
            $table->integer('festival_id');  
            $table->jsonb('images')->nullable();  
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotels');
    }       
}