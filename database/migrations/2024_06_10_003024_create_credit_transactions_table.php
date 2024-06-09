<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('document_number');
            $table->integer('operation_code');
            $table->string('recipient_name');
            $table->string('recipient_inn');
            $table->string('recipient_mfo');
            $table->string('recipient_account');
            $table->date('payment_date');
            $table->text('payment_description');
            $table->decimal('debit', 20, 2);
            $table->decimal('credit', 20, 2);
            $table->string('payer_name');
            $table->string('payer_inn');
            $table->string('payer_mfo');
            $table->string('payer_bank');
            $table->string('payer_account');
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
        Schema::dropIfExists('credit_transactions');
    }
}
