<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExpiringDonation extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE `donations` CHANGE COLUMN `status` `status` ENUM('pending', 'voided', 'assigned', 'recovered', 'dropped', 'expiring') DEFAULT 'pending'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE `donations` CHANGE COLUMN `status` `status` ENUM('pending', 'voided', 'assigned', 'recovered', 'dropped') DEFAULT 'pending'");
    }
}
