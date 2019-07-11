<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompaniesMetadata extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('opening_hours');
            $table->string('preferred_hours');
            $table->text('notes');
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['opening_hours']);
            $table->dropColumn(['preferred_hours']);
            $table->dropColumn(['notes']);
        });
    }
}
