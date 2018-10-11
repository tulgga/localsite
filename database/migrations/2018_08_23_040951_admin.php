<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Admin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('f_name', 50);
            $table->string('l_name', 50)->nullable();
            $table->string('user_name', 50);
            $table->string('password');
            $table->string('email', 50);
            $table->string('phone', 14)->nullable();
            $table->integer('admin_type');
            $table->string('profile_pic', 150)->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('admin');
    }
}
