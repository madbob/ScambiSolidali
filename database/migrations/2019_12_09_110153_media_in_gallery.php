<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MediaInGallery extends Migration
{
    public function up()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->string('context')->default('media');
            $table->text('text');
        });
    }

    public function down()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn(['context']);
            $table->dropColumn(['text']);
        });
    }
}
