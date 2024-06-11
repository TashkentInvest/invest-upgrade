<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsNumberTypeInTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('description');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->string('name')->nullable()->after('id');
            $table->text('description')->nullable()->after('name');
            $table->date('start_date')->nullable()->after('description');
            $table->date('end_date')->nullable()->after('start_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('description');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->text('description')->after('name');
            $table->date('start_date')->after('description');
            $table->date('end_date')->after('start_date');
        });
    }
}
