<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->text('contract_apt')->nullable();
            $table->dateTime('contract_date')->nullable();
            $table->string('generate_price')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('percentage_input')->nullable();
            $table->string('installment_quarterly')->nullable();
            $table->string('notification_num')->nullable();
            $table->dateTime('notification_date')->nullable();
            $table->string('Insurance_policy')->nullable();
            $table->string('bank_guarantee')->nullable();
            $table->string('application_number')->nullable();
            $table->string('payed_sum')->nullable();
            $table->dateTime('payed_date')->nullable();
            $table->string('first_payment_percent')->nullable();
            $table->string('branch_kubmetr')->nullable();
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
        Schema::dropIfExists('branches');
    }
}
