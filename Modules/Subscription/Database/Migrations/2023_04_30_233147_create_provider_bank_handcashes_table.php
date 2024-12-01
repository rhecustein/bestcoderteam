<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderBankHandcashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_bank_handcashes', function (Blueprint $table) {
            $table->id();
            $table->integer('provider_id')->default(0);
            $table->integer('bank_status')->default(0);
            $table->text('bank_instruction')->nullable();
            $table->integer('handcash_status')->default();
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
        Schema::dropIfExists('provider_bank_handcashes');
    }
}
