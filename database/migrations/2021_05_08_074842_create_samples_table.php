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
            $table->bigInteger('company_id')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->date('date')->nullable();
            $table->bigInteger('status_id')->nullable();
            $table->bigInteger('opportunity_id')->nullable();
            $table->string('subject')->nullable();
            $table->bigInteger('cargo_company_id')->nullable();
            $table->string('cargo_tracking_number')->nullable();
            $table->string('bus')->nullable();
            $table->string('cargo_tracking_number')->nullable();
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
