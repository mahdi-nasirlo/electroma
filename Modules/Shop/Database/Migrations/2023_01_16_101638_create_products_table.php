<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     * TODO: add category
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            // $table->json('gallery')->nullable();
            $table->string('cover')->nullable();
            $table->string('cover_hover')->nullable();
            $table->json("short_information")->nullable();
            $table->text("short_desc")->nullable();
            $table->bigInteger('price');
            $table->integer('inventory');
            $table->json("cover_tag")->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('shop_categories')->cascadeOnDelete()->cascadeOnUpdate();
            // $table->string("rating");
            $table->dateTime('published_at')->nullable();
            $table->text('content')->nullable();
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
        Schema::dropIfExists('products');
    }
};
