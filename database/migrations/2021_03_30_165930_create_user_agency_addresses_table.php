<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAgencyAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agency_addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('agency_id')->unsigned();
            $table->bigInteger('city_id')->unsigned();
            $table->string('address_line');
            $table->string('postcode');
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
        Schema::dropIfExists('agency_addresses');
    }
}
