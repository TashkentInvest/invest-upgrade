<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('companies')) {
            Schema::create('companies', function (Blueprint $table) {
                $table->id();
                $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
                $table->string('company_name')->nullable();
                $table->string('raxbar')->nullable();
                $table->string('bank_code')->nullable();
                $table->string('bank_service')->nullable();
                $table->string('bank_account')->nullable();
                $table->string('stir')->nullable()->unique();
                $table->string('oked')->nullable();
                $table->text('minimum_wage')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
