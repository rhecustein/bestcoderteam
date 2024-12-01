<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('location_id');
            $table->integer('provider_id');
            $table->string('name');
            $table->string('slug');
            $table->double('price');
            $table->string('image');
            $table->longText('details');
            $table->tinyInteger('make_featured')->default(0);
            $table->tinyInteger('make_popular')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_banned')->default(0);
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->longText('what_you_will_provide')->nullable();
            $table->longText('benifit')->nullable();
            $table->longText('package_features')->nullable();
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
        Schema::dropIfExists('services');
    }
}
