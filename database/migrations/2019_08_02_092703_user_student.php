<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserStudent extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE users CHANGE COLUMN role role ENUM('admin', 'operator', 'user', 'carrier', 'businness', 'student')");
        DB::statement("ALTER TABLE receivers CHANGE COLUMN type type ENUM('individual', 'organization', 'self')");
    }

    public function down()
    {
        DB::statement("ALTER TABLE users CHANGE COLUMN role role ENUM('admin', 'operator', 'user', 'carrier', 'businness')");
        DB::statement("ALTER TABLE receivers CHANGE COLUMN type type ENUM('individual', 'organization')");
    }
}
