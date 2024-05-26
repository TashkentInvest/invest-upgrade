<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->enum('mijoz_turi', ['yuridik', 'fizik']);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('contact')->nullable();
            $table->string('passport_serial')->nullable();
            $table->string('passport_pinfl')->nullable();
            $table->string('yuridik_address')->nullable();
            $table->string('yuridik_rekvizid')->nullable();
            $table->string('jamgarma_rekvizitlari')->nullable();
            $table->dateTime('passport_date')->nullable();
            $table->string('passport_location')->nullable();

            
            
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
        Schema::dropIfExists('Clients');
    }
}
