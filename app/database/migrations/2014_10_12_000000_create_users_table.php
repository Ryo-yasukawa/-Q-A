<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
   
    public function up():void
    {
       Schema::create('users', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name', 50);
        $table->string('email', 255)->unique();
        $table->string('password', 255);
        $table->string('password_reset_token', 255)->nullable();
        $table->string('profile_image', 255)->nullable();
        $table->text('introduction')->nullable();
        $table->integer('role')->default(2); 
        $table->integer('is_active')->default(1);
         $table->string('image_path')->nullable(); 
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
        Schema::dropIfExists('users');
    }
}
