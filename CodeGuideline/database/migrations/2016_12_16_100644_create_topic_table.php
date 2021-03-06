<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('topic', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tittle');
            $table->string('shortdescription');
            $table->longText('content');
            $table->string('image');
            $table->integer('status'); 
            $table->integer('viewed')->default(0);
            $table->integer('idCatagory')->unsigned();
            $table->foreign('idCatagory')->references('id')->on('catagory');
            $table->string('idTag');
            $table->integer('approvestatus');
            $table->string('approvedby');
            $table->timestamp('timeapproved');
            $table->integer('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('users');
            $table->integer('cmt_count')->default(0);
            $table->integer('vote_count')->default(0);
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
        Schema::drop('topic');
    }
}
