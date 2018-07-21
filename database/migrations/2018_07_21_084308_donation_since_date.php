<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DonationSinceDate extends Migration
{
    public function up()
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->date('since')->nullable()->default(null);
        });
    }

    public function down()
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn(['since']);
        });
    }
}
