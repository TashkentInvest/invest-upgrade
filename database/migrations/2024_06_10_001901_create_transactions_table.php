<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('document_number');
            $table->integer('operation_code');
            $table->string('payer_name');
            $table->string('payer_inn');
            $table->string('payer_mfo');
            $table->string('payer_account');
            $table->date('payment_date');
            $table->date('operation_day');
            $table->text('payment_description');
            $table->decimal('debit', 15, 2);
            $table->decimal('credit', 15, 2);
            $table->string('recipient_name');
            $table->string('recipient_inn');
            $table->string('recipient_mfo');
            $table->string('recipient_bank');
            $table->string('recipient_account');
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
        Schema::dropIfExists('transactions');
    }
}
