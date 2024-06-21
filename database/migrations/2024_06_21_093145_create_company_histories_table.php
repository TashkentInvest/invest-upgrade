<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Add user_id column

            $table->string('company_name')->nullable();
            $table->string('raxbar')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('bank_service')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('stir')->nullable()->unique();
            $table->string('oked')->nullable();
            $table->text('minimum_wage')->nullable();
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
        Schema::dropIfExists('company_histories');
    }
}
