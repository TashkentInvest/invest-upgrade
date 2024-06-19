<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApzColumnsToBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->string('apz_raqami')->nullable()->after('branch_type');
            $table->date('apz_sanasi')->nullable()->after('apz_raqami');
            $table->text('kengash')->nullable()->after('apz_sanasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn(['apz_raqami', 'apz_sanasi', 'kengash']);
        });
    }
}
