<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InstitutesWebsites extends Migration
{
    public function up()
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->string('website')->default('');
        });
    }

    public function down()
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->dropColumn(['website']);
        });
    }
}
