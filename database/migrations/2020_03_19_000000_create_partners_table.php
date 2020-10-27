<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersTable extends Migration
{
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->increments('id');
            $table->jsonb('name');
            $table->jsonb('descriprion')->nullable();
            $table->string('slug', 150)->unique();
            $table->jsonb('meta_title');
            $table->jsonb('meta_description')->nullable();            
            $table->string('logo', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('partners');
    }       
}
