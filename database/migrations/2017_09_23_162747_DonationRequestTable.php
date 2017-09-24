<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use doctrine\dbal;

class DonationRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DonationRequest', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organization_id')->unsigned()->index();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->string('formOrganization');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('phonenumber');
            $table->string('street_address1');
            $table->string('street_address2');
            $table->string('city');
            $table->string('state');
            $table->string('zipcode');
            $table->string('taxexempt');
            $table->string('formRequestFor');
            $table->string('formDonationPurpose');
            $table->string('eventname');
            $table->string('eventdate');
            $table->string('enddate');
            $table->string('eventpurpose');
            $table->string('formAttendees');
            $table->string('venue');
            $table->string('marketingopportunities');
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
        Schema::dropIfExists('DonationRequest');
    }
}
