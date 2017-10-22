<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReceiverType extends Migration
{
    public function up()
    {
        Schema::table('receivers', function (Blueprint $table) {
            $table->enum('type', ['individual', 'organization'])->default('individual');
            $table->string('organization')->nullable();
            $table->integer('receivers')->nullable();
        });
    }

    public function down()
    {
        Schema::table('receivers', function (Blueprint $table) {
            $table->dropColumn(['type']);
            $table->dropColumn(['organization']);
            $table->dropColumn(['receivers']);
        });
    }
}
