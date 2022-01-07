<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::create('customers', function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique()->nullable();
                $table->string('name')->nullable();
                $table->string('short_name')->nullable();
                $table->string('prefix')->nullable();
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->text('description')->nullable();

                $table->string('phone')->nullable();
                $table->string('email')->nullable();
                $table->string('address')->nullable();
                $table->dateTime('registry_date')->nullable();

                $table->unsignedBigInteger('area_id')->nullable();
                $table->unsignedBigInteger('city_id')->nullable();
                $table->unsignedBigInteger('district_id')->nullable();
                $table->unsignedBigInteger('ward_id')->nullable();

                $table->unsignedBigInteger('user_id')->nullable();
                // $table->foreign('user_id')->references('id')->on('users')->onUpdate('noaction')->onDelete('noaction');
                $table->unsignedBigInteger('shop_id')->nullable();
                $table->foreign('shop_id')->references('id')->on('shops');
                $table->string('business_id')->nullable();
                // $table->foreign('business_id')->references('id')->on('businesses');
                $table->string('customerorigin_id')->nullable();
                // $table->foreign('customerorigin_id')->references('id')->on('customerorigins');
                $table->string('shipping_id')->nullable();
                // $table->foreign('shipping_id')->references('id')->on('shippings');
                $table->unsignedBigInteger('status_id')->nullable();
                $table->foreign('status_id')->references('id')->on('statuses');
                
                $table->timestamps();
                $table->softDeletes();
            });        
        } catch (Exception $e) {
            logger($e);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
