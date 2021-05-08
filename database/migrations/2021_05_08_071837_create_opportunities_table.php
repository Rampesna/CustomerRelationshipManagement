<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpportunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable();
            $table->bigInteger('user_id');
            $table->string('number')->nullable();
            $table->longText('description')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('manager_name')->nullable();
            $table->string('manager_email')->nullable();
            $table->string('manager_phone_number')->nullable();
            $table->string('website')->nullable();
            $table->date('date')->nullable();
            $table->float('price')->nullable();
            $table->string('currency')->nullable();
            $table->bigInteger('priority_id')->nullable();
            $table->bigInteger('access_type_id')->nullable();
            $table->boolean('domestic')->nullable();
            $table->bigInteger('province_id')->nullable();
            $table->bigInteger('district_id')->nullable();
            $table->date('foundation_date')->nullable();
            $table->smallInteger('estimated_result')->nullable();
            $table->bigInteger('estimated_result_type_id')->nullable();
            $table->double('capacity')->nullable();
            $table->bigInteger('capacity_type_id')->nullable();
            $table->bigInteger('status_id')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('opportunities');
    }
}
