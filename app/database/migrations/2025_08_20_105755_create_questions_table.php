<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
  
    public function up():void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');              
        $table->integer('user_id');               
        $table->string('title', 100);            
        $table->text('body');                     
        $table->string('image_path', 255)->nullable(); 
        $table->integer('is_visible')->default(1);
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
        Schema::dropIfExists('questions');
    }
}
