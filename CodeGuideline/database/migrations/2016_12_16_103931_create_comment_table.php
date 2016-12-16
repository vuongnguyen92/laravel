<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('comment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idTopic')->unsigned();
            $table->foreign('idTopic')->references('id')->on('topic');
            $table->integer('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('users');            
            $table->string('content');
            $table->integer('vote');
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
        //
        Schema::drop('comment');
    }
}
