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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('guid')->nullable();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->string('title')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('office')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('website')->nullable();
            $table->bigInteger('country_id')->nullable()->unsigned();
            $table->bigInteger('province_id')->nullable()->unsigned();
            $table->bigInteger('district_id')->nullable()->unsigned();
            $table->date('foundation_date')->nullable();
            $table->bigInteger('class_id')->nullable()->unsigned();
            $table->bigInteger('type_id')->nullable()->unsigned();
            $table->bigInteger('reference_id')->nullable()->unsigned();
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
        Schema::dropIfExists('customers');
    }
}
