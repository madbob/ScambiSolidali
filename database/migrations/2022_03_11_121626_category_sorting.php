<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategorySorting extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->integer('sorting')->default(0);
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['sorting']);
        });
    }
}
