<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutesTable extends Migration
{
    public function up()
    {
        Schema::create('institutes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->float('lat');
            $table->float('lng');
            $table->string('code');
            $table->timestamps();
        });

        Schema::create('institute_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('institute_id');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('institutes');
        Schema::dropIfExists('institute_user');
    }
}
