<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     * TODO : add user relationship to Blog Post
     * TODO : add Category relationship to Blog Post
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_author_id')->nullable()->cascadeOnDelete();
            $table->foreign('blog_author_id')->references('id')->on('users');

            $table->foreignId('blog_category_id')->nullable()->nullOnDelete();
            $table->foreign("blog_category_id")->references('id')->on('blog_categories')->cascadeOnDelete();

            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->integer('view')->nullable()->default(0);
            $table->integer('read_time');
            $table->date('published_at')->nullable();
            $table->string('seo_title', 60)->nullable();
            $table->string('seo_description', 160)->nullable();
            $table->string('image');
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
        Schema::dropIfExists('blog_posts');
    }
};
