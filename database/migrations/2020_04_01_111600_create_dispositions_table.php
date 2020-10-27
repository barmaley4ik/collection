<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispositionsTable extends Migration
{
    public function up()
    {
        Schema::create('dispositions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image', 150);
            $table->integer('festival_id');
            $table->jsonb('meta_title');  
            $table->jsonb('meta_description')->nullable();  
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dispositions');
    }       
}