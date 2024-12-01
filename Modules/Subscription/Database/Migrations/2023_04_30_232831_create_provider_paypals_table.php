<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderPaypalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_paypals', function (Blueprint $table) {
            $table->id();
            $table->integer('provider_id')->default(0);
            $table->integer('status')->default(0);
            $table->string('account_mode')->default('sandbox');
            $table->text('client_id')->nullable();
            $table->text('secret_id')->nullable();
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
        Schema::dropIfExists('provider_paypals');
    }
}
