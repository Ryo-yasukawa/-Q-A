<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerReportsTable extends Migration
{

    public function up():void
    {
        Schema::create('answer_reports', function (Blueprint $table) {
             $table->bigIncrements('id');
             $table->integer('user_id')->nullable();
             $table->integer('answer_id')->nullable();
             $table->string('reason', 100);
             $table->text('comment')->nullable();
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
        Schema::dropIfExists('answer_reports');
    }
}
