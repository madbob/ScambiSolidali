<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallsTable extends Migration
{
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title');
            $table->text('body');
            $table->enum('status', ['draft', 'open', 'archived'])->default('draft');
            $table->timestamps();
        });

        Schema::table('donations', function (Blueprint $table) {
            $table->integer('call_id')->nullable()->default(null);
        });
    }

    public function down()
    {
        Schema::dropIfExists('calls');

        Schema::table('donations', function(Blueprint $table)
        {
            $table->dropColumn(['call_id']);
        });
    }
}
