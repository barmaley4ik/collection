<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBizProposalsTable extends Migration
{
    public function up()
    {
        Schema::create('biz_proposals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('language_id');
            $table->jsonb('member');
            $table->integer('specialization_id');
            $table->string('phone',20);
            $table->jsonb('social')->nullable();
            $table->jsonb('fotos')->nullable();
            $table->string('place_number', 15);
            $table->integer('place_format_id');
            $table->integer('count_worker')->nullable();
            $table->integer('fitting_room');
            $table->string('illumination',10)->nullable();
            $table->string('product',250);
            $table->integer('festival_id');
            $table->integer('status_id');
            $table->string('comment', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('biz_proposals');
    }       
}