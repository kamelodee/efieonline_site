<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertySalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('location_id');

  
            $table->string('title');

            $table->longText('description');

            $table->string('slug')->nullable();

            $table->string('property_type');

            $table->string('property_status');

            $table->string('property_label');

            $table->decimal('sale_price');
            $table->softDeletes();
            $table->string('currency');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_published')->default(false);
            $table->longText('features')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('location_id')->references('id')->on('locations');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_sales');
    }
}
