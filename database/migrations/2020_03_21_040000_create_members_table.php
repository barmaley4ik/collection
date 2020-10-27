<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->jsonb('name');
            $table->string('slug', 150)->unique();
            $table->jsonb('title');
            $table->jsonb('description')->nullable();
            $table->jsonb('studio')->nullable();
            $table->jsonb('social')->nullable();
            $table->string('logo', 100)->nullable();
            $table->jsonb('portfolio')->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->jsonb('city')->nullable();    
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('members');
    }       
}
