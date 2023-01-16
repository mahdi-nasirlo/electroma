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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('title')->max(255);

            $table->string('slug')->max(256);

            $table->string('image');

            $table->text('desc');

            $table->text('short_desc');

            $table->integer('price');

            $table->integer('inventory')->default(0);

            $table->integer('view')->default(0);

            $table->dateTime('published_at')->useCurrent();

            $table->json('common_questions');

            $table->json('attributes');

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
        Schema::dropIfExists('courses');
    }
};
