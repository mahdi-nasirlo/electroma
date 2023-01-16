<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string("code")->max(125);
            $table->dateTime("expired_at");
            $table->enum("type", ['percent', 'value', 'value_pre_product'])->default('percent');
            $table->bigInteger("discount_value");
            $table->boolean("is_delivery_free")->default(false);

            $table->unsignedBigInteger("exception_product_category_id");
            $table->foreign("exception_product_category_id")->references("id")->on("shop_categories");

            $table->json('mobiles')->nullable();
            $table->bigInteger("limit_on_use")->nullable();
            $table->bigInteger("limit_of_user_use")->nullable();

            $table->bigInteger("min_order_value")->nullable();

            $table->timestamps();
        });

        Schema::create('category_discount', function (Blueprint $table) {
            $table->unsignedBigInteger("discount_id");
            $table->foreign("discount_id")->references("id")->on("discounts");

            $table->unsignedBigInteger("category_id");
            $table->foreign("category_id")->references("id")->on("shop_categories")->cascadeOnDelete()->cascadeOnUpdate();

            $table->primary(['category_id', 'discount_id']);
        });

        Schema::create('discount_user', function (Blueprint $table) {
            $table->unsignedBigInteger("discount_id");
            $table->foreign("discount_id")->references("id")->on("discounts");

            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users");

            $table->primary(['user_id', 'discount_id']);
        });

        Schema::create('discount_product', function (Blueprint $table) {
            $table->unsignedBigInteger("discount_id");
            $table->foreign("discount_id")->references("id")->on("discounts");

            $table->unsignedBigInteger("product_id");
            $table->foreign("product_id")->references("id")->on("products");

            $table->primary(['product_id', 'discount_id']);
        });

        Schema::create('course_discount', function (Blueprint $table) {
            $table->unsignedBigInteger("discount_id");
            $table->foreign("discount_id")->references("id")->on("discounts");

            $table->unsignedBigInteger("course_id");
            $table->foreign("course_id")->references("id")->on("courses");

            $table->primary(['discount_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_discount');
        Schema::dropIfExists('discount_product');
        Schema::dropIfExists('discount_user');
        Schema::dropIfExists('discount');
    }
};
