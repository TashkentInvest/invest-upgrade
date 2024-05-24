<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tg_user_id');
            $table->string('menu');
            $table->string('lang');
            $table->string('surname')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('nation')->nullable();
            $table->string('sex')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('level')->nullable();
            $table->text('university_name')->nullable();
            $table->string('martial_status')->nullable();
            $table->text('specialty')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id')->references('id')->on('regions');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->string('address')->nullable();
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
        Schema::dropIfExists('current');
    }
}
