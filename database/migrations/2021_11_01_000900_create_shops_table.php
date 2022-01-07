<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::create('shops', function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique()->nullable();
                $table->string('name')->nullable();
                $table->string('short_name')->nullable();
                $table->string('prefix')->nullable();
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->text('description')->nullable();

                $table->unsignedBigInteger('customer_id')->nullable();
                $table->foreign('customer_id')->references('id')->on('customers');
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
        Schema::dropIfExists('shops');
    }
}
