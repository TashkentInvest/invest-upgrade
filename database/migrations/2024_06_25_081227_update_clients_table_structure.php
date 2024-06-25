<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateClientsTableStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            // Dropping unnecessary columns (if they exist)
            $columnsToDrop = [
                'yuridik_address',
                'home_address',
                'yuridik_rekvizid',
                'passport_serial',
                'passport_pinfl',
                'passport_date',
                'passport_location',
                'passport_type',
                'company_location',
                'company_name',
                'raxbar',
                'bank_code',
                'bank_service',
                'bank_account',
                'stir',
                'oked',
                'minimum_wage',
            ];

            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('clients', $column)) {
                    $table->dropColumn($column);
                }
            }

            // Adding new columns (if they do not exist)
            if (!Schema::hasColumn('clients', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable()->after('id');
                $table->foreign('category_id')->references('id')->on('categories');
            }

            if (!Schema::hasColumn('clients', 'mijoz_turi')) {
                $table->enum('mijoz_turi', ['yuridik', 'fizik'])->nullable()->after('category_id');
            }

            if (!Schema::hasColumn('clients', 'first_name')) {
                $table->string('first_name')->nullable()->after('mijoz_turi');
            }

            if (!Schema::hasColumn('clients', 'last_name')) {
                $table->string('last_name')->nullable()->after('first_name');
            }

            if (!Schema::hasColumn('clients', 'father_name')) {
                $table->string('father_name')->nullable()->after('last_name');
            }

            if (!Schema::hasColumn('clients', 'contact')) {
                $table->string('contact')->nullable()->after('father_name');
            }

            // Adding is_deleted column (if it does not exist)
            if (!Schema::hasColumn('clients', 'is_deleted')) {
                $table->boolean('is_deleted')->default(0)->after('contact');
                $table->index('is_deleted'); // Add index explicitly
            }

            // Adding status column (if it does not exist)
            if (!Schema::hasColumn('clients', 'status')) {
                $table->integer('status')->default(1)->after('is_deleted');
            }

            // Adding client_description column (if it does not exist)
            if (!Schema::hasColumn('clients', 'client_description')) {
                $table->string('client_description')->nullable()->after('status');
            }

         
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
            // Dropping newly added columns in the reverse migration
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->dropColumn('mijoz_turi');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('father_name');
            $table->dropColumn('contact');
            $table->dropColumn('is_deleted');
            $table->dropColumn('status');
            $table->dropColumn('client_description');

            // Re-adding previously dropped columns
            $table->string('yuridik_address')->nullable();
            $table->string('home_address')->nullable();
            $table->string('yuridik_rekvizid')->nullable();
            $table->string('passport_serial')->nullable();
            $table->string('passport_pinfl')->nullable();
            $table->dateTime('passport_date')->nullable();
            $table->string('passport_location')->nullable();
            $table->boolean('passport_type')->nullable()->default(0);
            $table->string('company_location')->nullable();
            $table->string('company_name')->nullable();
            $table->string('raxbar')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('bank_service')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('stir')->nullable();
            $table->string('oked')->nullable();
            $table->text('minimum_wage')->nullable();
        });
    }
}
