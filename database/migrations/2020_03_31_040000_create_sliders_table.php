<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->jsonb('text');
            $table->string('sort', 3);
            $table->string('image', 100)->nullable();
            $table->boolean('is_button');
            $table->string('url', 100);
            $table->integer('festival_id');    
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sliders');
    }       
}