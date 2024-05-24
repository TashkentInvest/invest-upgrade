<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_company', function (Blueprint $table) {
            $table->id();
            $table->text('name_uz');
            $table->text('name_ru');
            $table->text('text_uz');
            $table->text('text_ru');
            $table->string('image')->nullable();
            $table->string('link_name_1')->nullable();
            $table->string('link_1')->nullable();
            $table->string('link_name_2')->nullable();
            $table->string('link_2')->nullable();
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
        Schema::dropIfExists('about_company');
    }
}
