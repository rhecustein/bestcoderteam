<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderInstamojosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_instamojos', function (Blueprint $table) {
            $table->id();
            $table->integer('provider_id')->default(0);
            $table->text('api_key');
            $table->text('auth_token');
            $table->string('account_mode')->default('Sandbox');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('provider_instamojos');
    }
}
