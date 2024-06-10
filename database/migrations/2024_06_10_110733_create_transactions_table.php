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
            $table->string('name');
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('debet_transaction_id')->nullable();
            $table->unsignedBigInteger('credit_transaction_id')->nullable();
            $table->timestamps();

            $table->foreign('debet_transaction_id')->references('id')->on('debet_transactions')->onDelete('set null');
            $table->foreign('credit_transaction_id')->references('id')->on('credit_transactions')->onDelete('set null');
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
