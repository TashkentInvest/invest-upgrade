<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->string('shaxarsozlik_umumiy_xajmi')->nullable();
            $table->string('qavatlar_soni_xajmi')->nullable();
            $table->string('avtoturargoh_xajmi')->nullable();
            $table->string('qavat_xona_xajmi')->nullable();
            $table->string('umumiy_foydalanishdagi_xajmi')->nullable();
            $table->text('qurilish_turi')->nullable();
            $table->decimal('coefficient', 8, 2)->nullable();
            $table->string('zona')->nullable();


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
            $table->dropColumn('shaxarsozlik_umumiy_xajmi');
            $table->dropColumn('qavatlar_soni_xajmi');
            $table->dropColumn('avtoturargoh_xajmi');
            $table->dropColumn('qavat_xona_xajmi');
            $table->dropColumn('umumiy_foydalanishdagi_xajmi');
            $table->dropColumn('qurilish_turi');
            $table->dropColumn('coefficient');
            $table->dropColumn('zona');
        });
    }
}
