<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNominationsTable extends Migration
{
    public function up()
    {
        Schema::create('nominations', function (Blueprint $table) {
            $table->increments('id');
            $table->date('day');
            $table->jsonb('text_day');
            $table->integer('festival_id');    
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nominations');
    }       
}