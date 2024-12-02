<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('midtrans', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(0);
            $table->string('name')->nullable();
            $table->string('account_mode')->default('Sandbox');
            $table->string('image')->nullable();
            $table->text('client_key')->nullable();
            $table->text('secret_key')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('midtrans');
    }
};
