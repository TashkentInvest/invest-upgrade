<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('mijoz_turi', ['yuridik', 'fizik']);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->dateTime('user_birht');
            $table->string('serial_serial')->nullable();
            $table->string('serial_pinfl')->nullable();
            $table->string('yuridik_address')->nullable();
            $table->string('yuridik_rekvizid')->nullable();
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
        Schema::dropIfExists('clinets');
    }
}
