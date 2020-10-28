<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            //
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('job_title');
            $table->date('dob');
            $table->string('address', 250);
            $table->string('mobile', 12);
            $table->string('tfn');
            $table->string('superfund');
            $table->string('supernumber');
            $table->string('depot');
            $table->string('emergency');
            $table->string('emergency_contact');
            $table->string('employment_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
}