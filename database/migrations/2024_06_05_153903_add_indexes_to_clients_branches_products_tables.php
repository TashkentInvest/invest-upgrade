<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToClientsBranchesProductsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->index('is_deleted');
        });

        Schema::table('branches', function (Blueprint $table) {
            $table->index('client_id');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->index('client_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropIndex(['is_deleted']);
        });

        Schema::table('branches', function (Blueprint $table) {
            $table->dropIndex(['client_id']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['client_id']);
        });
    }
}
