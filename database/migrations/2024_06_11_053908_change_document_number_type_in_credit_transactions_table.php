<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDocumentNumberTypeInCreditTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('credit_transactions', function (Blueprint $table) {
            $table->dropColumn('document_number');
        });

        Schema::table('credit_transactions', function (Blueprint $table) {
            $table->bigInteger('document_number')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('credit_transactions', function (Blueprint $table) {
            $table->dropColumn('document_number');
        });

        Schema::table('credit_transactions', function (Blueprint $table) {
            $table->integer('document_number')->after('id');
        });
    }
}
