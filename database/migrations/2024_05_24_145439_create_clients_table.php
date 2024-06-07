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
            $table->enum('mijoz_turi', ['yuridik', 'fizik'])->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('contact')->nullable();
            $table->string('yuridik_address')->nullable();
            $table->string('yuridik_rekvizid')->nullable();
            $table->string('passport_serial')->nullable();
            $table->string('passport_pinfl')->nullable();
            $table->dateTime('passport_date')->nullable();
            $table->string('passport_location')->nullable();
            $table->boolean('passport_type')->nullable()->default(0);
            $table->boolean('is_deleted')->nullable()->default(0);
            $table->string('client_description')->nullable();
            $table->string('company_location')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_type')->nullable();
            $table->string('raxbar')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('bank_service')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('stir')->nullable();
            $table->string('oked')->nullable();

            $table->text('minimum_wage')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('Clients');
    }
}
