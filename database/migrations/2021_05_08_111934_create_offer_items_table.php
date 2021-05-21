<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('offer_id')->unsigned()->nullable();
            $table->bigInteger('stock_id')->unsigned()->nullable();
            $table->bigInteger('unit_id')->unsigned()->nullable();
            $table->double('unit_price')->unsigned()->nullable();
            $table->double('amount')->unsigned()->nullable();
            $table->double('vat_rate')->unsigned()->nullable();
            $table->double('vat_total')->unsigned()->nullable();
            $table->double('discount_rate')->unsigned()->nullable();
            $table->double('discount_total')->unsigned()->nullable();
            $table->double('subtotal')->unsigned()->nullable();
            $table->double('grand_total')->unsigned()->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('offer_items');
    }
}
