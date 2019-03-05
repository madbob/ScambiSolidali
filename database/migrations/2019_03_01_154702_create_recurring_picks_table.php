<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecurringPicksTable extends Migration
{
    public function up()
    {
        Schema::create('recurring_picks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('institute_id');
            $table->boolean('closed')->default(false);
            $table->text('contents');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recurring_picks');
    }
}
