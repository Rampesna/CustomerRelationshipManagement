<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceListItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_list_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('price_list_id')->unsigned()->nullable();
            $table->bigInteger('stock_id')->unsigned()->nullable();
            $table->double('unit_price')->unsigned()->nullable();
            $table->double('vat_rate')->unsigned()->nullable();
            $table->string('currency_type')->nullable();
            $table->double('currency')->unsigned()->nullable();
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
        Schema::dropIfExists('price_list_items');
    }
}
