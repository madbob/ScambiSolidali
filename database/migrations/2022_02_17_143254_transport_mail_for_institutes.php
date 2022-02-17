<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransportMailForInstitutes extends Migration
{
    public function up()
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->string('transport_mail')->default('');
        });
    }

    public function down()
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->dropColumn(['transport_mail']);
        });
    }
}
