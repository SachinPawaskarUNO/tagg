<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyMonthlyBudgetDaysNoticeDefaultsOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->decimal('monthly_budget', 11, 2)->default(0.00)->change();
            $table->integer('required_days_notice')->default(14)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->decimal('monthly_budget', 11, 2)->nullable()->change();
            $table->integer('required_days_notice')->default(14)->change();
        });
    }
}
