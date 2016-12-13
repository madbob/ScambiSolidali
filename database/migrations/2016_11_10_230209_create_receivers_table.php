<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiversTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('receivers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('surname');
            $table->string('address', 200);
            $table->string('phone');
            $table->string('email');
            $table->text('notes');
            $table->timestamps();
        });

        Schema::create('donation_receiver', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('donation_id');
            $table->integer('receiver_id');
            $table->integer('operator_id');
            $table->text('notes');
            $table->enum('status', ['booked', 'assigned', 'shipping_needed', 'shipped', 'voided']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('receivers');
        Schema::dropIfExists('donation_receiver');
    }
}
