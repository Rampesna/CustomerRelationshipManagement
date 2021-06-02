<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('guid')->nullable();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('short_name')->nullable();
            $table->double('wholesale_vat')->nullable();
            $table->double('retail_vat')->nullable();
            $table->string('currency_type')->nullable();
            $table->bigInteger('unit_type_id')->nullable()->unsigned();
            $table->double('unit_price')->nullable();
            $table->bigInteger('type_id')->nullable()->unsigned();
            $table->bigInteger('status_id')->nullable()->unsigned();
            $table->double('amount')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('last_updated_by')->nullable();
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
        Schema::dropIfExists('stocks');
    }
}
