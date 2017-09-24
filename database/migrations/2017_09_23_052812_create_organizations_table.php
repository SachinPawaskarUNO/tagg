<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use doctrine\dbal;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            // TODO: Flesh out Org and ParentChildOrg tables more
            $table->increments('id');
            $table->string('org_name');
            $table->string('org_description')->nullable();
            $table->string('street_address1');
            $table->string('street_address2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zipcode');
            $table->string('phone_number');
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
        Schema::dropIfExists('organizations', function (Blueprint $table) {
            //
        });
    }
}