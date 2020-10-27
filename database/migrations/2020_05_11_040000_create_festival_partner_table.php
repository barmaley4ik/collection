<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFestivalPartnerTable extends Migration
{
    public function up()
    {
        Schema::create('festival_partner', function (Blueprint $table) {
            $table->integer('festival_id');
            $table->integer('partner_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('festival_partner');
    }       
}