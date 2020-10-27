<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalsTable extends Migration
{
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('language_id');
            $table->jsonb('member');
            $table->integer('specialization_id');
            $table->jsonb('studio')->nullable();
            $table->integer('country_id');
            $table->jsonb('city',50);
            $table->string('phone',20);
            $table->jsonb('social')->nullable();
            $table->string('logo', 150)->nullable();
            $table->jsonb('portfolio')->nullable();
            $table->string('place_number', 15);
            $table->integer('place_format_id');
            $table->integer('count_worker')->nullable();
            $table->integer('festival_id');
            $table->integer('status_id');
            $table->string('comment', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proposals');
    }       
}