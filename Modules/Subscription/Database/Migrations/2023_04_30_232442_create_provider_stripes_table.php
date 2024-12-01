<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderStripesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_stripes', function (Blueprint $table) {
            $table->id();
            $table->integer('provider_id')->default(0);
            $table->integer('status')->default(0);
            $table->text('stripe_key')->nullable();
            $table->text('stripe_secret')->nullable();
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
        Schema::dropIfExists('provider_stripes');
    }
}
