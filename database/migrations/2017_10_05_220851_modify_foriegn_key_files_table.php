<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyForiegnKeyFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('files', function (Blueprint $table) {
        //     $table->dropForeign(['organization_id']);
        // });
        // Schema::table('files', function (Blueprint $table) {
        //     $table->dropColumn('organization_id');
        // });
        // Schema::table('files', function (Blueprint $table) {
        //     $table->integer('donation_request_id')->unsigned();
        // });
        // Schema::table('files', function (Blueprint $table) {
        //     $table->foreign('donation_request_id')->references('id')->on('donation_requests')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('files', function (Blueprint $table) {
        //     $table->dropForeign(['donation_request_id']);
        // });
        // Schema::table('files', function (Blueprint $table) {
        //     $table->dropColumn('donation_request_id');
        // });
        // Schema::table('files', function (Blueprint $table) {
        //     $table->integer('organization_id')->unsigned();
        // });
    }
}
