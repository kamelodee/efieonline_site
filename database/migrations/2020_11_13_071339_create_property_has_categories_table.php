<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyHasCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_has_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('property_rent_id')->unsigned();
            $table->bigInteger('property_sale_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();

            $table->timestamps();
            $table->foreign('property_rent_id')->references('id')->on('property_rents');
            $table->foreign('property_sale_id')->references('id')->on('property_sales');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_has_categories');
    }
}
