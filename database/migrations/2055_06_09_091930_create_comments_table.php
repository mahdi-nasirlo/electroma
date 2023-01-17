<?php

use App\Models\Shop\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up()
    {
        Schema::dropIfExists('shop_reviews');

        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

            $table->unsignedBigInteger('commentable_id');

            $table->string('commentable_type');

            $table->boolean('is_visible')->default(false);

            $table->text('content');

            $table->unsignedBigInteger('parent_id')->nullable()->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
