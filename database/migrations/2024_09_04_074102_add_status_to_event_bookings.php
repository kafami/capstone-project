<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddStatusToEventBookings extends Migration
{
    public function up()
    {
        Schema::table('event_bookings', function (Blueprint $table) {
            $table->string('status')->default('pending'); // or any other default value you want
        });
    }

    public function down()
    {
        Schema::table('event_bookings', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}