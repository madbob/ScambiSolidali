<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShippingOptions extends Migration
{
    public function up()
    {
        Schema::table('receivers', function (Blueprint $table) {
            $table->string('shipping_name')->default('');
            $table->string('shipping_address')->default('');
        });
    }

    public function down()
    {
        Schema::table('receivers', function (Blueprint $table) {
            $table->dropColumn(['shipping_name']);
            $table->dropColumn(['shipping_address']);
        });
    }
}
