<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id')->references('id')->on('regions');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('company_location');
            $table->string('generate_price');
            $table->string('payment_type');
            $table->string('percentage_input');
            $table->string('installment_quarterly')->nullable();
            $table->string('company_kubmetr')->nullable();
            $table->string('company_type')->nullable();
            $table->string('company_name')->nullable();
            $table->text('contract_apt')->nullable();
            $table->dateTime('contract_date');
            $table->string('raxbar')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('bank_service')->nullable();
            $table->string('stir')->nullable();
            $table->string('oked')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
