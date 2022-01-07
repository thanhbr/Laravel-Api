<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
                $table->string('code')->unique()->nullable();
                $table->string('name')->nullable();
                $table->string('short_name')->nullable();
                $table->string('prefix')->nullable();
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->text('description')->nullable();

                $table->mediumText('path_file_upload')->nullable();
                $table->mediumText('path_file_export')->nullable();
                // $table->string('address')->nullable();
                $table->dateTime('sign_date')->nullable();
                $table->dateTime('effect_date')->nullable();
                $table->dateTime('expiration_date')->nullable();
                $table->integer('amount')->nullable();

                $table->unsignedBigInteger('user_id')->nullable();
                // $table->foreign('user_id')->references('id')->on('users')->onUpdate('noaction')->onDelete('noaction');
                $table->string('customer_id')->nullable();
                // $table->foreign('customer_id')->references('id')->on('customers');
                $table->unsignedBigInteger('shop_id')->nullable();
                $table->foreign('shop_id')->references('id')->on('shops');
                $table->string('business_id')->nullable();
                // $table->foreign('business_id')->references('id')->on('businesses');
                $table->string('customerorigin_id')->nullable();
                // $table->foreign('customerorigin_id')->references('id')->on('customerorigins');
                $table->unsignedBigInteger('type_id')->nullable();
                $table->foreign('type_id')->references('id')->on('types');
                $table->unsignedBigInteger('status_id')->nullable();
                $table->foreign('status_id')->references('id')->on('statuses');
                $table->unsignedBigInteger('updated_by')->nullable();
                // $table->foreign('user_id')->references('id')->on('users')->onUpdate('noaction')->onDelete('noaction');
                
                $table->timestamps();
                $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
