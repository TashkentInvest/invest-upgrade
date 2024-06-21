<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Add user_id column

            $table->index('client_id');

            $table->text('contract_apt')->nullable();
            $table->date('contract_date')->nullable();
            $table->string('generate_price')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('percentage_input')->nullable();
            $table->string('installment_quarterly')->nullable();
            $table->string('branch_kubmetr')->nullable();
            $table->string('branch_location')->nullable();

            $table->string('branch_name')->nullable();
            $table->string('branch_type')->nullable();

            $table->string('apz_raqami')->nullable();
            $table->date('apz_sanasi')->nullable();
            $table->text('kengash')->nullable();

            $table->string('notification_num')->nullable();
            $table->date('notification_date')->nullable();
            $table->string('insurance_policy')->nullable();
            $table->string('bank_guarantee')->nullable();   
            $table->string('application_number')->nullable();
            $table->string('payed_sum')->nullable();
            $table->date('payed_date')->nullable();
            $table->string('first_payment_percent')->nullable();

            $table->string('event')->nullable();
            
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
        Schema::dropIfExists('branch_histories');
    }
}
