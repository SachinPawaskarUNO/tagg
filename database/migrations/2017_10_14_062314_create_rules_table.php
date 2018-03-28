<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rule_type_id')->unsigned()->index();
            $table->foreign('rule_type_id')->references('id')->on('rule_types')->onDelete('cascade');

            $table->integer('rule_owner_id')->unsigned()->index();
            $table->foreign('rule_owner_id')->references('id')->on('organizations')->onDelete('cascade');
            
            $table->text('orgtype')->nullable(); // preferred organization types
            $table->text('dntype')->nullable(); // preferred donation request types
            $table->integer('amtreq')->default(0); // preferred request donation amount 
            $table->boolean('taxex')->default(true);
            $table->boolean('active')->default(true);
            
            $table->timestamps();
        });
        Schema::table('parent_child_organizations', function (Blueprint $table) {
            $table->integer('rule_id')->unsigned()->index()->after('child_org_id');
            $table->foreign('rule_id')->references('id')->on('rules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parent_child_organizations', function (Blueprint $table) {
            $table->dropForeign(['rule_id']);
            $table->dropColumn('rule_id');
        });
        Schema::dropIfExists('rules');
        Schema::dropIfExists('rule_types');
    }
}
