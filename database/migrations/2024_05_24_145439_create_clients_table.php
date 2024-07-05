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
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->enum('mijoz_turi', ['yuridik', 'fizik'])->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('contact')->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->integer('status')->default(0);
            $table->text('client_description')->nullable();
            $table->timestamps();
        
            $table->index('is_deleted');
            $table->index(['last_name', 'first_name']);
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_histories');
        Schema::dropIfExists('Clients');
    }
}
