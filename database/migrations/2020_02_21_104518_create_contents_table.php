<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('thumbnail')->nullable();
            $table->text('content');
            $table->tinyInteger('level');
            $table->integer('duration')->nullable();
            $table->string('documents');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->bigInteger('author');
            $table->boolean('is_done')->nullable();
            $table->boolean('is_approve')->nullable();
            $table->bigInteger('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups');
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
        Schema::dropIfExists('contents');
    }
}
