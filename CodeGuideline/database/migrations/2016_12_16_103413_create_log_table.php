<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idTopic')->unsigned();
            $table->foreign('idTopic')->references('id')->on('topic')->onDelete('cascade');
            $table->integer('logApprovestatus');
            $table->string('logApprovedby');
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
        Schema::drop('log');
    }
}
