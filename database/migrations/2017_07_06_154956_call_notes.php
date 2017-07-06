<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CallNotes extends Migration
{
    public function up()
    {
        Schema::table('calls', function (Blueprint $table) {
            $table->string('notes');
        });
    }

    public function down()
    {
        Schema::table('calls', function (Blueprint $table) {
            $table->dropColumn(['notes']);
        });
    }
}
