<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_rent_id')->nullable();
            $table->unsignedBigInteger('property_sale_id')->nullable();
            $table->string('features')->nullable();
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
        Schema::dropIfExists('features');
    }
    
}