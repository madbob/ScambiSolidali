<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoreShippingOptions extends Migration
{
    public function up()
    {
        Schema::table('receivers', function (Blueprint $table) {
            $table->string('shipping_floor')->default('');
            $table->boolean('shipping_elevator')->default(false);
        });
    }

    public function down()
    {
        Schema::table('receivers', function (Blueprint $table) {
            $table->dropColumn(['shipping_floor']);
            $table->dropColumn(['shipping_elevator']);
        });
    }
}
