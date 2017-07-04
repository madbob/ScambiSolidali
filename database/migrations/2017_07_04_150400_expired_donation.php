<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExpiredDonation extends Migration
{
    public function up()
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn(['really_recoverable']);
        });

        DB::statement("ALTER TABLE `donations` CHANGE COLUMN `status` `status` ENUM('pending', 'voided', 'assigned', 'recovered', 'dropped', 'expiring', 'expired') DEFAULT 'pending'");
    }

    public function down()
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->boolean('really_recoverable')->default(false);
        });

        DB::statement("ALTER TABLE `donations` CHANGE COLUMN `status` `status` ENUM('pending', 'voided', 'assigned', 'recovered', 'dropped', 'expiring') DEFAULT 'pending'");
    }
}
