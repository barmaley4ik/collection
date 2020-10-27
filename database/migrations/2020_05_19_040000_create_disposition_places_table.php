<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispositionPlacesTable extends Migration
{
    public function up()
    {
        Schema::create('disposition_places', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('disposition_id');
            $table->jsonb('place');
            $table->jsonb('member');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('disposition_places');
    }       
}