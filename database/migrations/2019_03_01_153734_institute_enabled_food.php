<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InstituteEnabledFood extends Migration
{
    public function up()
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->boolean('food')->default(false);
        });
    }

    public function down()
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->dropColumn(['food']);
        });
    }
}
