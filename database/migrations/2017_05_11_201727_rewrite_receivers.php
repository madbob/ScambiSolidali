<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RewriteReceivers extends Migration
{
    public function up()
    {
        Schema::table('receivers', function (Blueprint $table) {
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('status')->nullable();
            $table->string('children')->nullable();
            $table->string('area')->nullable();
            $table->string('country')->nullable();
            $table->integer('past')->default(0);

            $table->dropColumn(['name']);
            $table->dropColumn(['surname']);
            $table->dropColumn(['address']);
            $table->dropColumn(['phone']);
            $table->dropColumn(['email']);
            $table->dropColumn(['notes']);
        });
    }

    public function down()
    {
        Schema::table('receivers', function (Blueprint $table) {
            $table->string('name');
            $table->string('surname');
            $table->string('address', 200);
            $table->string('phone');
            $table->string('email');
            $table->text('notes');

            $table->dropColumn(['age']);
            $table->dropColumn(['gender']);
            $table->dropColumn(['status']);
            $table->dropColumn(['children']);
            $table->dropColumn(['area']);
            $table->dropColumn(['country']);
            $table->dropColumn(['past']);
        });
    }
}
