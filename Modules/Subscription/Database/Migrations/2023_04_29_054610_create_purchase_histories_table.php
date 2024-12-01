<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('provider_id');
            $table->integer('plan_id');
            $table->string('plan_name');
            $table->string('plan_price');
            $table->string('expiration_date');
            $table->string('expiration');
            $table->string('maximum_service');
            $table->string('status');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->string('transaction');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_histories');
    }
}
