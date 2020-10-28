<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('booking_reference')->unique()->default(uniqid('ucan_booking_'));
            $table->string('name');
            $table->enum('type', ['bin', 'pickup'])->nullable();
            $table->tinyInteger('no_of_bins')->nullable()->max(30)->default(0);
            $table->date('expected_date')->nullable();
            $table->time('expected_time')->nullable();
            $table->string('address', 250);
            $table->string('mobile', 12);
            $table->enum('status', ['done', 'accepted', 'declined'])->nullable();
            $table->string('scheme_id', 10)->nullable();
            $table->string('instructions', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
