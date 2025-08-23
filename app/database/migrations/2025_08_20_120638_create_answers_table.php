<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
  
    public function up():void
    {
        Schema::create('answers', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->integer('user_id');
        $table->integer('question_id');
        $table->text('body');
        $table->string('image_path', 255)->nullable();
        $table->tinyInteger('is_visible')->default(1);
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
        Schema::dropIfExists('answers');
    }
}
