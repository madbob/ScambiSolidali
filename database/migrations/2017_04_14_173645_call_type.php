<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CallType extends Migration
{
    public function up()
    {
        Schema::table('calls', function (Blueprint $table) {
            $table->enum('type', ['object', 'service'])->default('object');
        });
    }

    public function down()
    {
        Schema::table('calls', function (Blueprint $table) {
            $table->dropColumn(['type']);
        });
    }
}
