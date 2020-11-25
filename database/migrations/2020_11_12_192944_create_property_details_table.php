<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('property_rent_id')->nullable();
            $table->unsignedBigInteger('property_sale_id')->nullable();
            $table->string('nature_of_building')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->decimal('Area')->nullable();
            $table->date('year_build')->nullable();
            $table->string('car_packing')->nullable();
            $table->string('security')->nullable();
            $table->string('electricity')->nullable();
            $table->string('waste_disposal')->nullable();
            $table->string('toilet')->nullable();
            $table->string('landlord_residential_status')->nullable();
            $table->string('kitchen')->nullable();
            $table->string('compound_cleaning')->nullable();
            $table->string('water')->nullable();
            $table->string('kitchen_type')->nullable();
            $table->string('special_condition')->nullable();
            $table->longText('reason')->nullable();
            $table->string('bathroom_type')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('property_rent_id')->references('id')->on('property_rents');
            $table->foreign('property_sale_id')->references('id')->on('property_sales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_details');
    }
}
