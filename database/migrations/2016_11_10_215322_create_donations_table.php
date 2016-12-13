<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->string('title');
            $table->text('description');
            $table->string('name');
            $table->string('surname');
            $table->string('address');
            $table->float('lat');
            $table->float('lng');
            $table->string('phone')->default('');
            $table->string('email')->default('');
            $table->text('shipping_notes');
            $table->boolean('recoverable')->default(false);
            $table->string('uuid');
            $table->json('availability');

            /*
                pending: caricata sulla piattaforma
                voided: scartato
                assigned: assegnato
                recovered: recuperato da Triciclo
                dropped: definitivamente abbandonato
            */
            $table->enum('status', ['pending', 'voided', 'assigned', 'recovered', 'dropped'])->default('pending');

            $table->integer('rating')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
