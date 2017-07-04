<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClosedCalls extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE `calls` CHANGE COLUMN `status` `status` ENUM('draft', 'open', 'archived', 'closed') DEFAULT 'draft'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE `calls` CHANGE COLUMN `status` `status` ENUM('draft', 'open', 'archived') DEFAULT 'draft'");
    }
}
