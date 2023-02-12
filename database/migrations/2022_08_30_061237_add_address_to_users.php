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
        Schema::table('users', function (Blueprint $table) {
            $table->string("mobile")->nullable();
            $table->string("state")->nullable();
            $table->string("city")->nullable();
            $table->string("post")->nullable();
            $table->string("address")->nullable();
            $table->string("last_name")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->removeColumn("mobile");
            $table->removeColumn("state");
            $table->removeColumn("city");
            $table->removeColumn("post");
            $table->removeColumn("address");
            $table->removeColumn("last_name");
        });
    }
};
