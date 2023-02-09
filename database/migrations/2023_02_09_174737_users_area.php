<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersArea extends Migration
{
    public function up()
    {
		Schema::table('users', function (Blueprint $table) {
            $table->string('area')->nullable()->default(null);
        });
    }

    public function down()
    {
		Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['area']);
        });
    }
}
