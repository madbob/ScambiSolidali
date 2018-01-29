<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Donation;

class DropRecoverable extends Migration
{
    public function up()
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn(['recoverable']);
        });

        Donation::where('status', 'recovered')->update(['status' => 'dropped']);
        DB::statement("ALTER TABLE donations CHANGE COLUMN status status ENUM('pending', 'voided', 'assigned', 'dropped', 'expiring', 'expired')");
    }

    public function down()
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->boolean('recoverable')->default(false);
        });
    }
}
