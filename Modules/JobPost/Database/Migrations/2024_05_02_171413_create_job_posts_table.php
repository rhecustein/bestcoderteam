<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->integer('category_id');
            $table->integer('city_id');
            $table->string('thumb_image');
            $table->string('slug');
            $table->string('job_type');
            $table->string('title');
            $table->longText('description');
            $table->text('address')->nullable();
            $table->bigInteger('total_view')->default(0);
            $table->decimal('regular_price', 8, 2);
            $table->string('is_urgent')->default('disable');
            $table->string('status')->default('disable');
            $table->string('approved_by_admin')->default('pending');
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
        Schema::dropIfExists('job_posts');
    }
};
