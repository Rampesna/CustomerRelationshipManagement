<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->string('relation_type')->nullable();
            $table->bigInteger('relation_id')->nullable()->unsigned();
            $table->string('subject')->nullable();
            $table->text('description')->nullable();
            $table->date('expiry_date')->nullable();
            $table->bigInteger('pay_type_id')->nullable()->unsigned();
            $table->bigInteger('delivery_type_id')->nullable()->unsigned();
            $table->string('currency_type')->nullable();
            $table->double('currency')->nullable()->unsigned();
            $table->bigInteger('status_id')->nullable()->unsigned();
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
        Schema::dropIfExists('offers');
    }
}
