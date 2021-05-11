<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->bigInteger('customer_id')->nullable()->unsigned();
            $table->bigInteger('opportunity_id')->nullable()->unsigned();
            $table->date('date')->nullable();
            $table->bigInteger('status_id')->nullable()->unsigned();
            $table->string('subject')->nullable();
            $table->bigInteger('cargo_company_id')->nullable()->unsigned();
            $table->string('cargo_tracking_number')->nullable();
            $table->string('bus_company')->nullable();
            $table->string('car_plate')->nullable();
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
        Schema::dropIfExists('samples');
    }
}
