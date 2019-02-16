<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecurringsTable extends Migration
{
    public function up()
    {
        Schema::create('recurrings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->boolean('filled')->default(false);
            $table->boolean('closed')->default(false);
            $table->string('identifier')->unique();
            $table->text('contents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recurrings');
    }
}
