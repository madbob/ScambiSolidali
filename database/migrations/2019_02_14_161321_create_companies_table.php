<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->float('lat');
            $table->float('lng');
            $table->string('email');
            $table->string('phone');
            $table->string('website');
            $table->enum('donation_frequency', ['none', 'weekly', 'monthly'])->default('none');
            $table->timestamps();
        });

        Schema::create('company_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->integer('user_id');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE users CHANGE COLUMN role role ENUM('admin', 'operator', 'user', 'carrier', 'businness')");
    }

    public function down()
    {
        Schema::dropIfExists('company_user');
        Schema::dropIfExists('companies');
    }
}
